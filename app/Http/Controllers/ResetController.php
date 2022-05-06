<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\UserPasswordResetMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;

class ResetController extends Controller
{


    private const MAIL_SENDED_SESSION_KEY = 'user_reset_password_mail_sended_action';
    private const UPDATE_PASSWORD_SESSION_KEY = 'user_update_password_action';


    public function emailFormResetPassword(){
        return view('reset');
    }

    public function getEmail(sendEmailRequest $request){
        try{
            $user = User::where('email',$request->email)->first();
            if(!empty($user)){
                session_start();
                $_SESSION['id'] = $user->id;
                return redirect()->route('password_reset.edit');
            }
        }catch(Exception $e){
            Log::error(__METHOD__ . '...ユーザーへのパスワード再設定用メール送信に失敗しました。 request_email = ' . $request->email . ' error_message = ' . $e);
            return redirect()->route('password_reset.email.form')
                ->with('flash_message', '処理に失敗しました。時間をおいて再度お試しください。');
        }

        session()->put(self::MAIL_SENDED_SESSION_KEY, 'user_reset_password_send_email');
        return redirect("password_reset.form")
            ->with('flash_message','ユーザーが見つかりません');
    }

    
    public function sendComplete()
    {
       // 不正アクセスを防ぐ
        if (session()->pull(self::MAIL_SENDED_SESSION_KEY) !== 'user_reset_password_send_email') {
            return redirect(route('password_reset.email.form'))
                ->with('flash_message', '不正なリクエストです。');
        }

        return view('resetResult');
    }

    public function edit(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user =$_SESSION['id'];
        session()->put(self::MAIL_SENDED_SESSION_KEY, 'user_reset_password_send_email');
        return view('editPass',compact('user'));
    }

    public function update(Request $request)
    {
        Log::info('関数を呼び出した');
        //不正アクセス制限
        if (empty($request->id)) {
            Log::error('不正なアクセス');
            return redirect()->route('password_reset.email.form')
                ->with('flash_message', '不正なリクエストです。');
        }

        //バリデージョン
        $validator = Validator::make($request->all(),[
            'password' => 'required | min:8',
            'password_confirmation' => 'required'
        ]);
        if($validator->fails()){
            Log::error('バリデーションエラー');
            return redirect('password_reset.email.form')
                    ->withError($validator);
        }

        //確認用と一致してるか確認
        if($request->password != $request->password_confirmation){
            Log::error('コンフィルムエラー');
            return redirect('password_reset.email.form')
                    ->with('message','確認用のパスワードと一致しません');
        }

        //
        try {
            $id = $request->id;
            User::where('id',$id)->update(['password_hash' => Hash::make($request->password) ]);
        } catch (Exception $e) {
            Log::error(__METHOD__ . '...ユーザーのパスワードの更新に失敗しました。...error_message = ' . $e);
            return redirect()->route('password_reset.email.form')
                ->with('flash_message', __('処理に失敗しました。時間をおいて再度お試しください。'));
        }
        // パスワードリセット完了画面への不正アクセスを防ぐためのセッションキー
        $request->session()->put(self::UPDATE_PASSWORD_SESSION_KEY, 'user_update_password');
        return view("edited");
    }

    public function edited()
    {
        // パスワード更新処理で保存したセッションキーに値がなければアクセスできないようにすることで不正アクセスを防ぐ
        if (session()->pull(self::UPDATE_PASSWORD_SESSION_KEY) !== 'user_update_password') {
            return redirect()->route('password_reset.email.form')
                ->with('flash_message', '不正なリクエストです。');
        }

        return view('edited');
    }
}

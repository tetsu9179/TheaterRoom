<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\TalkRoom;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class UserController extends Controller
{
    /*
    * 登録画面に遷移するメソッド
    */
    public function register(){
        return view("register");
    }

    /*
    *ホームへ
    */
    public function home(){
        $myTalkRoom = array();
        $invitedTalkRoom = array();

        // セッションは有効で、開始していないときセッション会誌
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['id'];

        /*ログインIDからユーザーとトークルーム情報を取得 */
        $user = $this->getUserbyId($id);                
        $talkRooms = $this->myTalkRoom($id);

        /*トークルームの作者ごとにルームの種類を*/
        foreach($talkRooms as $talkRoom){
            if($talkRoom->host_user_id == $user->id){
                array_push($myTalkRoom,$talkRoom);
            }else{
                array_push($invitedTalkRoom,$talkRoom);
            }
        }
        return view("home",compact("user","myTalkRoom","invitedTalkRoom"));
    }

    /*
    * ログイン機能
    */
    public function login(Request $request){
        $myTalkRoom = array();
        $invitedTalkRoom = array();
        /*入力されているか判断*/
        $validate = Validator::make($request->all(),[
            'loginId' => 'required',
            'password' => 'required'
        ]);
        
        /*問題なければユーザー情報を取得*/
        if($validate->fails()){
            return redirect("/")
            ->withErrors($validate);
        }else{
            $loginId = $request->get('loginId');
            $password = $request->get('password');
            $user = User::where('email',$loginId)->first();

            /*eメールで無ければ電話番号で検索*/
            if(empty($user)){
                $user = User::where('tel',$loginId)->first();
                if(empty($user)){
                    return redirect("/")
                            ->with("message","パスワードが一致しません");
                }
            }

            /*パスワードチェック*/
            if(password_verify($password,$user->password_hash)){
                session_start();
                $_SESSION['id'] = $user->id;
                $_SESSION['admin_flg'] = $user->admin_flg;
                
                return redirect('/home');                    
            }else{
                return redirect("/")
                        ->with("message","パスワードが一致しません");
            }
        }
    }

        


    public function addUser(Request $request){

        $validate = Validator::make($request->all(),[
            'thumbnail' => 'image|mimes:jpeg,png,jpg',
            'name' => 'required',
            'email' => 'required | email',
            'tel' => 'digits_between:0,11'
        ]);
        if($validate->fails()){
            return redirect('/register')->withErrors($validate)->withInput();
        }

        $thumbnailName = 'userIcon.png';

        if(!empty($request->thumbnail)){
            $file = $request->thumbnail;
            $extension = $file->getClientOriginalExtension();
            $thumbnailName = $file->getClientOriginalName();
            $thumbnailName = time().$file->getClientOriginalName();
            $targetPath = public_path('thumbnails/');
            $file->move($targetPath,$thumbnailName);
        }



        /*ユーザー登録*/
        try{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->tel = $request->tel;
            $user->password_hash = Hash::make($request->password);
            $user->icon_pass = $thumbnailName;
            $user->profile_messege = $request->statesMsg;
            $user->save();
            $id = $user->where('email',$user->email)->first();
            session_start();
            $_SESSION['id'] = $user->id;
            
            $myTalkRoom = $this->myTalkRoom($id);
            return view("home",compact("user","myTalkRoom"));
        }catch(Exception $e){
            report($e);
            session()->flash('messege','アカウント作成に失敗しました');
        }

    }

    public function edit(){
        session_start();
        $user = $this->getUserbyId($_SESSION['id']);

        return view("edit",compact("user"));
    }

    public function update(Request $request){
        session_start();
        $id = $_SESSION['id'];

        /*バリデーション*/
        $validate = Validator::make($request->all(),User::$rules);
        if($validate->fails()){
            return redirect('/edit')
                    ->withErrors($validate);
        }
        $thumbnailName = 'userIcon.png';
        Log::info($thumbnailName);

        /*写真をサーバーに保存*/
        if(!empty($request->thumbnail)){
            Log::info($thumbnailName.'を追加');
            $file = $request->thumbnail;
            $extension = $file->getClientOriginalExtension();
            $thumbnailName = $file->getClientOriginalName();

            $thumbnailName = time().$file->getClientOriginalName();
            $targetPath = public_path('thumbnails/');
            $file->move($targetPath,$thumbnailName);
        }else{
            Log::error('ファイルが空ですね');
        }
        Log::info($thumbnailName);



        /*ユーザー情報の更新*/
        try{
            User::where('id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'tel' => $request->tel,
                'icon_pass' =>$thumbnailName,
                'profile_messege' => $request->statesMsg
            ]);
            Log::info($thumbnailName);
        }catch(Exception $e){
            report($e);
            Log::error('プロフィール編集に失敗しました。 errorMessage:'.$e);
        }
        return redirect('/home');
        
    }

    public function logout(){
        session_start();
        session()->flush();

        return redirect('/');
    }

    public function myTalkRoom($id){
        $talkRoom = DB::table('room_members')->leftjoin('talk_rooms','room_id','=','talk_rooms.id');
        $myTalkRoom = $talkRoom
                    ->orderBy('talk_rooms.created_at','DESC')
                    ->where('member_id','=',$id)
                    ->where('del_flg','=',0)
                    ->get();

        return $myTalkRoom;
    }

    public static function getUserbyId(int $id){
        return User::where('id',$id)->first();
    }

    
        
    
}

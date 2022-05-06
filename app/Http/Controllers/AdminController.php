<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserController;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    /*管理者ログイン用メソッド*/ 
    public function admin(){
        session_start();
        if($_SESSION['admin_flg'] != 1 || !isset($_SESSION['admin_flg'])){
            return redirect('/');
        }else{
            $id = $_SESSION['id'];
            return view('adminLogin',compact("id"));
        }
    }

    public function login(Request $request){
        try{
            session_start();
            $validate = Validator::make($request->all(),[
                'password' => 'required'
            ]);
            
            
            if($validate->fails()){
                return redirect("/admin")
                ->withErrors($validate);
            }else{
                $password = $request->get('password');
                $admin = Admin::where('user_id',$_SESSION['id'])->first();


                if(password_verify($password,$admin->password_hash)){
                    $_SESSION['admin'] = $admin->id;
                    return redirect('/admin/home');                    
                }else{
                    return redirect("/admin")
                            ->with("message","パスワードが一致しません");
                }
            }
        }catch(Exception $e){
            return redirect('/');
        }
    }

    public function home(){
        if (session_status() == PHP_SESSION_NONE) {
            // セッションは有効で、開始していないとき
            session_start();
        }
        if($_SESSION['admin_flg'] != 1 || !isset($_SESSION['admin_flg'])){
            return redirect('/');
        }
        return view("adminMenu");
    }

    public function contact(Request $request){
        $contact = new Contact;
        $contacts = array();
        $count = $contact->count();
        $index = 1;
        if($count <= 20){
            for($i = 1; $i <= $count; $i++){
                $item = $contact->where('id',$i)->first();
                array_push($contacts,$item);
            }
        }else{
            $index = $count/20;
            $page = $request->page-1;
            $start= 20*$page;
            for($i = $start+1; $i <= 20*$request->page; $i++){
                $item = $contact->where('id',$i)->first();
                array_push($contacts,$item);
            }
        }


        return view('contactCheck',compact("contacts","index"));

    }

    public function check(){
        
        return view('adminCheck');
    }

    public function register(Request $request){
        $validate = Validator::make($request->all(),[
            'id' => 'required | email'
        ]);
        if($validate->fails()){
            return redirect('/admin/register')
                    ->withErrors($validate);
        }
        $user = User::where('email',$request->id)->first();
        if(empty($user)){
            $error = "ユーザーが見つかりません";
            return redirect('/admin/register')
                    ->with("error",$error);
        }
        return view("adminSearch",compact("user"));
    }

    public function addAdmin(Request $request){
        $user=UserController::getUserbyId($request->id);
        $user->admin_flg = 1;
        $user->save();

        $admin = new Admin;
        try{
            $admin->user_id = $user->id;
            $admin->name = $user->name;
            $admin->password_hash = Hash::make($request->password);
            $admin->save();
        }catch(Exception $e){
            report($e);
            session()->flash('messege','アカウント作成に失敗しました');
        }

        return view('adminResult');
    }
}

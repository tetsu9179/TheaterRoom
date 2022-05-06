<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User; 
use App\Models\Friend;


class FriendController extends Controller
{
    /* ユーザー検索 */
    public function request(Request $request){
        session_start();
        $id = $_SESSION['id'];
        $user = new User;

        /*バリデーションルールを設定*/
        $emailRegStr = '/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/';
        $telRegStr = '/^0\d{8,11}/';

        /*メアドと一致するならメアドで検索、電話番号なら電話番号で検索*/
        if(preg_match($emailRegStr,$request['id'])){
            $user = User::where('email',$request['id'])->first();
        }else if(preg_match($telRegStr,$request['id'])){
            $user = User::where('tel',$request['id'])->first();
        }else{
            $error = "メールアドレスもしくは電話番号を入れてください";
            return redirect("/friend")
                    ->with("error",$error);
        }

        if(empty($user)){
            $error = "ユーザーが見つかりません";
            return redirect("/friend")
                    ->with("error",$error);
        }else{
            
            if($id == $user->id){
                $error = "このユーザーを追加することはできません";
                return redirect("/friend")
                    ->with("error",$error);
            }

            return view("search",compact("user"));
        }
    }

    /* 友達メニューに遷移するメソッド */
    public function read(){
        session_start();

        $friends = $this->friends($_SESSION['id']);

        $getRequests = DB::table("friends")
                        ->leftjoin('users','send_user_id','=','users.id')
                        ->where('got_user_id','=',$_SESSION['id'])
                        ->where('request_flg','=', 0 )
                        ->get();
        

        return view("friendMenu",compact("friends","getRequests"));
    }

    /* 友達追加メソッド */
    public function insert(Request $request){
        session_start();

        try{
            $friend = new Friend;
            $friend->send_user_id = $_SESSION['id'];
            $friend->got_user_id = $request['id'];

            $requestFriend = Friend::where(
                                            ['send_user_id','=',$request['id']],
                                            ['got_user_id','=',$_SESSION['id']],

            );

            if(!empty($requestFriend)){
                $friend->request_flg = 1;
            }
            $friend->save();

            return redirect('/friend');

        }catch(Exception $e){
            report($e);
            session()->flash('messege','アカウント作成に失敗しました');
        }
    }

    public function rejection(Request $request){
        session_start();
        $requestFriend = Friend::where('send_user_id','=',$request['id'])
                                ->where('got_user_id','=',$_SESSION['id'])
                                ->first();

        $requestFriend->request_flg = 1;
        $requestFriend->save();

        return redirect('/friend');


    }

    /*
    *追加した友達を探すメソッド
    *
    *@param id=ユーザーID
    *
    *@return 友達のユーザーID
    */

    public function friends($id){
        $table = DB::table("friends")->leftjoin('users','got_user_id','=','users.id')->get();

        $friends = $table->where('send_user_id','=',$id);

        return $friends;
    }
}
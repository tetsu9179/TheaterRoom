<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\TalkRoom;
use App\Http\Controllers\FriendController;

class TalkRoomController extends Controller
{
    //
    /* トークルームを作成 */
    public function create(Request $request){
        session_start();
        $id = $_SESSION['id'];
        $validate = Validator::make($request->all(),TalkRoom::$rules);
        
        if($validate->fails()){
            return redirect("/talkRoom")
            ->withError($validate)
            ->withInput();
        }else{
            $file = $request->roomImage;
            $roomImageName = time().$file->getClientOriginalName();
            $targetPath = public_path('roomImage/');
            $file->move($targetPath,$roomImageName);

            $talkroom = new TalkRoom;
            $talkroom->name = $request->name;
            $talkroom->thumbnail_pass = $roomImageName;
            $talkroom->host_user_id = $id;
            $talkroom->save();

            $talkroom = $talkroom->where([
                ['name','=',$request->name],
                ['thumbnail_pass','=',$roomImageName]
            ])->first();

            $friendControllew = new FriendController;
            $friends = $friendControllew->friends($id);

            return view("addMember",compact("talkroom","friends"));
        }
    }

    public function addMember(Request $request){
        session_start();
        $friendController = new FriendController;
        $friends = $friendController->friends($_SESSION['id']);
        $talkroom = TalkRoom::where('id',$request->room)->first();

        
        try{
            if(empty($request->friends)){
                $message = "ユーザーを選択してください";
                return view("addMember",compact("message","friends","talkroom"));
            }

            $roomMember = DB::table("room_members")->insert([
                'room_id' => $request->room,
                'member_id' => $_SESSION['id']
            ]);

            foreach($request->friends as $friend){
                $roomMember = DB::table("room_members")->insert([
                    'room_id' => $request->room,
                    'member_id' => $friend
                ]);
            }

            $talkroom->del_flg = 0;
            $talkroom->save();

            
        }catch(Exception $e){
            report($e);
            session()->flash('messege','アカウント作成に失敗しました');
        }
        
        
        return redirect('/home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\TalkRoom;
use App\Models\Chats;

class ChatController extends Controller
{
    //
    public function chat(Request $request){
        session_start();
        $_SESSION['room'] = $request->room;

        return redirect()->route('chat');
    }

    public function send(Request $request){
        session_start();
            $chat = new Chats;
            $chat->room_id = $request->room;
            $chat->send_user_id = $_SESSION['id'];
            $chat->message = $request->chat;
            $chat->save();
            
            return redirect()->route('chat');
    }

    public function talkRoom(){
        session_start();
        $chats=$this->talk($_SESSION['room']);
        $room = $this->room($_SESSION['room']);
        return view("chat",compact("chats","room"));
    }

    public function getdata(){
        session_start();
        $chats = $this->talk($_SESSION['room']);
        $json = [
                'chats' => $chats,
                'id' => $_SESSION['id']
                ];
        return response()->json($json);
    }

    public function talk($id){
        $chats=Chats::leftjoin('users','users.id','=','send_user_id')
                ->where('room_id',$id)
                ->orderBy('chats.created_at','asc')
                ->get(); 

        return $chats;
    }

    public function room($id){
        $room = TalkRoom::where('id',$id)->first();

        return $room;
    }
}

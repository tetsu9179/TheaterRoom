<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserController;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function insert(Request $request){
        $Validator=Validator::make($request->all(),['contactContent'=>'required']);
        if($Validator->fails()){
            return redirect('/contact')
                    ->withErrors($Validator);
        }
        session_start();
        $user = UserController::getUserById($_SESSION['id']);
        $contact = new Contact;
        try{
            $contact->send_user_id = $_SESSION['id'];
            $contact->email = $user->email;
            $contact->title = $request->title;
            $contact->message  = $request->contactContent;
            $contact->save();
        }catch(Exception $e){
            report($e);
            session()->flash('messege','アカウント作成に失敗しました');
        }

        return view('result');
    }
}

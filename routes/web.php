<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TalkRoomController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login',[UserController::class,"login"]);
Route::get('/register',[UserController::class,"register"]);
Route::get('/home',[UserController::class,"home"]);
Route::post('/addUser',[UserController::class,"addUser"]);
Route::get('/friend',[FriendController::class,"read"]);
Route::get('/makeRoom',function(){
    return view("makeRoom");
});
Route::get('/edit',[UserController::class,"edit"]);
Route::post('/update',[UserController::class,"update"]);
Route::post('/addMember',[TalkRoomController::class,"create"]);
Route::post('/room',[TalkRoomController::class,"addMember"]);
Route::post('/request',[FriendController::class,"request"]);
Route::post('/addFriend',[FriendController::class,"insert"]);
Route::get('/sendChat',[ChatController::class,"chat"]);
Route::post('/chat',[ChatController::class,"chat"]);
Route::get('/talkRoom',[ChatController::class,"talkRoom"])->name('chat');
Route::get('/chat/getMessage',[ChatController::class,"getData"]);
Route::post('/send',[ChatController::class,"send"]);
Route::get('/logout',[UserController::class,"logout"]);

Route::prefix('password_reset')->name('password_reset.')->group(function () {
    Route::prefix('email')->name('email.')->group(function () {
        // パスワードリセットメール送信フォームページ
        Route::get('/', [ResetController::class, 'emailFormResetPassword'])->name('form');
        // メール送信処理
        Route::post('/', [ResetController::class, 'getEmail'])->name('send');
    });
    // パスワード再設定ページ
    Route::get('/edit', [ResetController::class, 'edit'])->name('edit');
    // パスワード更新処理
    Route::post('/update', [ResetController::class, 'update'])->name('update');
    // パスワード更新終了ページ
    Route::get('/edited', [ResetController::class, 'edited'])->name('edited');
});
Route::get('/contact',function(){
    return view("contact");
});

Route::post('/rejection',[FriendController::class,"rejection"]);
Route::post('/contactResult',[ContactController::class,"insert"]);

Route::prefix('admin')->group(function(){
    Route::get('/',[AdminController::class,'admin']);
    Route::post('/',[AdminController::class,'login']);
    Route::get('/home',[AdminController::class,'home']);
    Route::prefix('contact')->group(function(){
        Route::get('/',[AdminController::class,'contact']);
    });
    Route::prefix('register')->group(function(){
        Route::get('/',[AdminController::class,'check']);
        Route::post('/',[AdminController::class,'register']);
        Route::post('/add',[AdminController::class,'addAdmin']);
    });
});
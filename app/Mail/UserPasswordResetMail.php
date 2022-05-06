<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
Use App\Models\UserToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class UserPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        UserToken $userToken
    )
    {
        $this->user = $user;
        $this->userToken = $userToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tokenParam = ['reset' => $this->userToken->token];
        $now = Carbon::now();

        $url = URL::temporarySignedRoute('password_reset.edit',$now->addHour(48),$tokenParam);
        
    
        return $this->from('tetsu8137@gmail.com','シアタールーム')
                ->to($this->user->email)
                ->subject('パスワードをリセット')
                ->view('Mail.passwordResetMail')
                ->with([
                    'user' => $this->user,
                    'url' => $url,
                    'limit' => $now->addHour(48),
                    'param' => $tokenParam
                ]);
    }
}

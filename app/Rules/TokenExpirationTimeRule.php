<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;

class TokenExpirationTimeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 現在時間とトークンの有効期限を比較して期限内ならTrueを返す
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        $now = Carbon::now();   //現在時刻
        $userTokenRepository = app()->make(UserTokenRepository::class);
        $userToken = $userTokenRepository->getUserTokenFromToken($value);
        $expiretime = new Carbon($userToken->expire_at);//トークンの有効期限

        return $now->lte($expiretime);
    }

    /**
     * エラーメッセージ
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

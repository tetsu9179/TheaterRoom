<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalkRoom extends Model
{
    use HasFactory;

    public static $rules = [
        'roomImage' => 'required | image',
        'name' => 'required',
    ];
}

<?php

namespace App\Models\Users\Auth;

use App\Lib\Slime\Models\SlimeModel;

class SocialProvider extends SlimeModel
{
    protected $fillable = [
        'name'
    ];
}
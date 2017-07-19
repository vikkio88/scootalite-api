<?php

namespace App\Models\Users;

use App\Lib\Slime\Models\SlimeModel;

class Admin extends SlimeModel
{
    protected $fillable = [
        'user_id'
    ];
}
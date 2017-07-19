<?php

namespace App\Models\Misc;

use App\Lib\Slime\Models\SlimeModel;

class Language extends SlimeModel
{
    protected $fillable = [
        'iso',
        'name'
    ];

}
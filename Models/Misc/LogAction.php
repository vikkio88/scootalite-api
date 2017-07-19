<?php

namespace App\Models\Misc;

use App\Lib\Slime\Models\SlimeModel;

class LogAction extends SlimeModel
{
    protected $fillable = [
        'navigator',
        'ip',
        'action'
    ];
}
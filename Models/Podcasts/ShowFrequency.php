<?php

namespace App\Models\Podcasts;

use App\Lib\Slime\Models\SlimeModel;

class ShowFrequency extends SlimeModel
{
    public $timestamps = false;
    protected $fillable =[
        'name',
        'time_diff'
    ];
}
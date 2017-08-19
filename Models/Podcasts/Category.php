<?php

namespace App\Models\Podcasts;

use App\Lib\Slime\Models\SlimeModel;

class Category extends SlimeModel
{
    protected $fillable = [
        'name'
    ];
}
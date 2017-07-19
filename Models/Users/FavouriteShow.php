<?php

namespace App\Models\Users;

use App\Lib\Slime\Models\SlimeModel;
use App\Models\Podcasts\Show;

class FavouriteShow extends SlimeModel
{
    protected $fillable = [
        'user_id',
        'show_id'
    ];

    public function show()
    {
        return $this->hasOne(Show::class, 'id', 'show_id');
    }
}
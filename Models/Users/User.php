<?php

namespace App\Models\Users;

use App\Lib\Slime\Models\SlimeModel;

class User extends SlimeModel
{
    protected $fillable = [
        'name',
        'username',
        'email'
    ];

    public function scopeInfo($query)
    {
        return $query->with(
            'listening',
            'listening.podcast',
            'favourites',
            'favourites.show'
        );
    }

    public function listening()
    {
        return $this->hasOne(UserActivePodcast::class);
    }

    public function favourites()
    {
        return $this->hasMany(FavouriteShow::class);
    }
}
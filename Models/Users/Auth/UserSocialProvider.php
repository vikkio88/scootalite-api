<?php

namespace App\Models\Users\Auth;

use App\Lib\Slime\Models\SlimeModel;
use App\Models\Users\User;

class UserSocialProvider extends SlimeModel
{
    protected $fillable = [
        'user_id',
        'social_provider_id',
        'provider_user_id'
    ];

    public function provider()
    {
        $this->belongsTo(SocialProvider::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

}
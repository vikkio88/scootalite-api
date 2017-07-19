<?php

namespace App\Models\Users;

use App\Lib\Slime\Models\SlimeModel;
use App\Models\Podcasts\Podcast;

class UserActivePodcast extends SlimeModel
{
    protected $visible = [
        'position',
        'podcast'
    ];

    protected $fillable = [
        'user_id',
        'podcast_id',
        'position'
    ];

    protected $casts = [
        'position' => 'int'
    ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
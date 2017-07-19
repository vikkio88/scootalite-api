<?php

namespace App\Models\Users;

use App\Lib\Slime\Models\SlimeModel;

class FeedRequest extends SlimeModel
{
    protected $fillable = [
        'feed_url',
        'radio_name',
        'radio_id',
        'user_id',
        'approved'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'radio_id' => 'int'
    ];

    public function scopeInfo($query)
    {
        return $query->with('user');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models\Podcasts;

use App\Lib\Slime\Models\SlimeModel;

class Podcast extends SlimeModel
{
    protected $fillable = [
        'name',
        'description',
        'duration',
        'date',
        'file_url',
        'radio_show_id',
        'previous_podcast_id',
        'next_podcast_id',
    ];


    public function next()
    {
        return $this->hasOne(
            Podcast::class,
            'id',
            'next_podcast_id'
        );
    }

    public function previous()
    {
        return $this->hasOne(
            Podcast::class,
            'id',
            'previous_podcast_id'
        );
    }


    public function show()
    {
        return $this->belongsTo(
            Show::class,
            'show_id'
        );
    }

    public function scopeComplete($query)
    {
        return $query->with(
            'show',
            'previous',
            'next'
        );
    }

    public function scopeLatestByShowId($query, $showId)
    {
        return $query->where
        (
            'radio_show_id',
            $showId
        )->orderBy('created_at', 'desc');
    }
}
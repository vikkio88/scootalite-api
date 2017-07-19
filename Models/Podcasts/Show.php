<?php

namespace App\Models\Podcasts;

use App\Lib\Slime\Models\SlimeModel;
use App\Models\Misc\Language;

class Show extends SlimeModel
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'author',
        'explicit',
        'radio_id',
        'language_id',
        'website',
        'feed_url',
        'logo_url',
        'frequency_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
        'language_id'
    ];

    protected $casts = [
        'explicit' => 'boolean'
    ];

    public function podcasts()
    {
        return $this->hasMany(Podcast::class)
            ->orderBy('date', 'DESC')
            ->limit(10);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function scopeInfo($query)
    {
        return $query->with(
            'podcasts',
            'language'
        );
    }
}
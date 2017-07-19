<?php

namespace App\Models\Podcasts;

use App\Lib\Slime\Models\SlimeModel;
use App\Models\Misc\Language;

class Radio extends SlimeModel
{
    protected $fillable = [
        'name',
        'description',
        'language_id',
        'website',
        'logo_url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
        'language_id'
    ];

    protected $filters = [
        'name' => [
            'col' => 'name',
            'op' => 'LIKE'
        ]
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    public function scopeComplete($query)
    {
        return $query->with(
            'language',
            'shows'
        );
    }
}
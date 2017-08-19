<?php

namespace App\Models\Podcasts;

use App\Lib\Helpers\PodcastFeedImporter;
use App\Lib\Helpers\RadioFeedGateway;
use App\Lib\Slime\Models\SlimeModel;
use App\Models\Misc\Language;
use Carbon\Carbon;

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
        'pivot',
        'language_id'
    ];

    protected $casts = [
        'explicit' => 'boolean'
    ];

    public function expired()
    {
        return $this->updated_at->diffInHours(Carbon::now()) > $this->valid_for;
    }

    public static function upsertFromFeed($feedUrl)
    {
        //check if show is there with feed url
        $show = self::info()->where(['feed_url' => $feedUrl])->first();

        if (!empty($show) && !$show->expired()) {
            return $show;
        }

        //if show was not present
        $radioFeedGateway = new RadioFeedGateway();
        $parsed = $radioFeedGateway->getFullPodcastArrayFromFeed(
            $feedUrl
        );


        $feed = new PodcastFeedImporter($parsed, $feedUrl);
        $show = $feed->getShowInfo()->toArray();
        //check if show is there
        $show = Show::updateOrCreate($show);
        //check when was updated and update podcasts
        $parsedPodcasts = $feed->getPodcastsInfo();
        $podcasts = [];
        foreach ($parsedPodcasts as $podcast) {
            $podcastData = $podcast->toArray();
            $podcast = Podcast::updateOrCreate(
                [
                    'show_id' => $show->id,
                    'file_url' => $podcastData['file_url']
                ],
                array_merge(
                    ['show_id' => $show->id],
                    $podcastData
                )
            );

            $podcasts[] = $podcast;
        }
        $show->podcasts = $podcasts;

        return $show;
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class)
            ->orderBy('date', 'DESC')
            ->limit(10);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'show_categories');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function scopeInfo($query)
    {
        return $query->with(
            'language',
            'categories'
        );
    }

    public function scopeComplete($query)
    {
        return $query->with(
            'podcasts',
            'language',
            'categories'
        );
    }
}
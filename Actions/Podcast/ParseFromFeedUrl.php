<?php

namespace App\Actions\Podcast;

use App\Lib\Helpers\PodcastFeedImporter;
use App\Lib\Helpers\RadioFeedGateway;
use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Podcasts\Podcast;
use App\Models\Podcasts\Show;
use Carbon\Carbon;

class ParseFromFeedUrl extends ApiAction
{
    protected $show = [];
    protected $podcasts = [];

    protected function performChecks()
    {
        $feedChunks = parse_url($this->getJsonRequestBody()['feed']);
        $feedUrl = sprintf('%s://%s%s', $feedChunks['scheme'], $feedChunks['host'], $feedChunks['path']);;
        //check if show is there with feed url
        $this->show = Show::info()->where(['feed_url' => $feedUrl])->first();

        if (!empty($this->show) && $this->show->updated_at->diffInHours(Carbon::now()) > 8) {
            dd($this->show->updated_at->diffInDays(Carbon::now()) > 1);
            return;
        }

        //if not parse
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
            $podcast = Podcast::updateOrCreate(
                array_merge(
                    ['show_id' => $show->id],
                    $podcast->toArray()
                )
            );
            $podcasts[] = $podcast;
        }
        $show->podcasts = $podcasts;
        $this->show = $show;
    }

    protected function performAction()
    {
        $this->payload = $this->show;
    }
}
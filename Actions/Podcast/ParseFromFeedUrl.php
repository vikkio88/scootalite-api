<?php

namespace App\Actions\Podcast;

use App\Lib\Helpers\PodcastFeedImporter;
use App\Lib\Helpers\RadioFeedGateway;
use App\Lib\Slime\RestAction\ApiAction;

class ParseFromFeedUrl extends ApiAction
{
    protected $show = [];
    protected $podcasts = [];

    protected function performChecks()
    {
        $feedUrl = $this->getJsonRequestBody()['feed'];
        //check if show is there with feed url

        //if not create
        $radioFeedGateway = new RadioFeedGateway();
        $parsed = $radioFeedGateway->getFullPodcastArrayFromFeed(
            $feedUrl
        );

        $feed = new PodcastFeedImporter($parsed);
        $show = $feed->getShowInfo()->toArray();
        //check if show is there

        //check when was updated and update podcasts
        $podcasts = $feed->getPodcastsInfo();

        $this->show = $show;
        $this->podcasts = $podcasts;
    }

    protected function performAction()
    {


        $this->payload = array_merge(
            $this->show,
            [
                'podcasts' => $this->podcasts
            ]
        );
    }
}
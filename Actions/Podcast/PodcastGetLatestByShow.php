<?php


namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Podcasts\Podcast;

class PodcastGetLatestByShow extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Podcast::latestByShowId($this->args['showId'])->first();
    }
}
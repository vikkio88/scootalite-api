<?php

namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Podcasts\Show;

class ParseFromFeedUrl extends ApiAction
{
    protected function performAction()
    {
        $feedChunks = parse_url($this->getJsonRequestBody()['feed']);
        $feedUrl = sprintf('%s://%s%s', $feedChunks['scheme'], $feedChunks['host'], $feedChunks['path']);;
        $this->payload = Show::upsertFromFeed($feedUrl);
    }
}
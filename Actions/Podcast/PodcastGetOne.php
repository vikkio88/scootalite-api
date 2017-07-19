<?php


namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Podcasts\Podcast;

class PodcastGetOne extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Podcast::complete()
            ->where(
                'id',
                $this->args['id']
            )->first();
    }
}
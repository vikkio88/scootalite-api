<?php


namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Podcasts\Show;

class ShowGetOne extends ApiAction
{
    protected function performAction()
    {
        $this->payload = Show::info()->where(
            [
                'radio_id' => $this->args['id'],
                'id' => $this->args['showId'],
            ]
        )->first();
    }
}
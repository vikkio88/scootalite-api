<?php

namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Podcasts\Show;

class ShowGetOneBySlug extends ApiAction
{
    protected function performAction()
    {
        $this->payload = Show::complete()
            ->where('slug', $this->args['slug'])
            ->first();
    }
}
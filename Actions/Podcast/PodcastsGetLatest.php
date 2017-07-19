<?php

namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\Podcasts\Podcast;

class PodcastsGetLatest extends ApiAction
{
    use Pagination;
    protected function performAction()
    {
        $this->pagination = $this->getPaginationParams($this->request);
        $this->payload = Podcast::page($this->pagination)
            ->with('show')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
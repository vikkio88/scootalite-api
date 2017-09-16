<?php


namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\Podcasts\Show;

class ShowGetAll extends ApiAction
{
    use Pagination;

    protected function performAction()
    {
        $this->pagination = $this->getPaginationParams($this->request);
        $this->payload = Show::info()
            ->orderBy('updated_at', 'DESC')
            ->page($this->pagination)->get();
    }
}
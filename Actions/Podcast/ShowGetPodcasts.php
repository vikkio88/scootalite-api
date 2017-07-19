<?php


namespace App\Actions\Podcast;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\Podcasts\Podcast;

class ShowGetPodcasts extends ApiAction
{
    use Pagination;

    protected function performAction()
    {
        $this->pagination = $this->getPaginationParams($this->request);
        $this->payload = Podcast::complete()
            ->where(
                'radio_show_id',
                $this->args['showId']
            )->orderBy('created_at', 'DESC')
            ->page($this->pagination)->get();;


    }
}
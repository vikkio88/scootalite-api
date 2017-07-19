<?php

namespace App\Actions\User\LoggedIn;

use App\Actions\Base\AuthApiAction;
use App\Models\Users\FavouriteShow;

class FavouriteShowDelete extends AuthApiAction
{
    protected function performAction()
    {
        $this->payload = FavouriteShow::where([
            'user_id' => $this->userId,
            'show_id' => $this->args['showId']
        ])->delete();
    }
}
<?php

namespace App\Actions\User\LoggedIn;

use App\Actions\Base\AuthApiAction;
use App\Models\Users\FavouriteShow;

class FavouriteShowAdd extends AuthApiAction
{
    protected function performAction()
    {
        $body = $this->getJsonRequestBody();
        $userFavourite = FavouriteShow::firstOrNew(
            [
                'user_id' => $this->userId,
                'show_id' => $body['show_id']
            ]
        );
        $this->payload = $userFavourite->save();
    }
}
<?php


namespace App\Actions\User\LoggedIn;

use App\Actions\Base\AuthApiAction;
use App\Models\Users\User;

class MyInfoGet extends AuthApiAction
{
    protected function performAction()
    {
        $this->payload = User::info()
            ->where(
                'id',
                $this->userId
            )->first();
    }
}
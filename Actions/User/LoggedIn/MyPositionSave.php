<?php


namespace App\Actions\User\LoggedIn;

use App\Actions\Base\AuthApiAction;
use App\Models\Users\UserActivePodcast;

class MyPositionSave extends AuthApiAction
{
    protected function performAction()
    {
        $body = $this->getJsonRequestBody();
        $userPodcast = UserActivePodcast::firstOrNew(
            [
                'user_id' => $this->userId
            ]
        );

        //todo: move podcast inside the firstOrNew if we want more than one podcast saved per user
        $userPodcast->podcast_id = $body['podcast_id'];
        $userPodcast->position = intval($body['position']);
        $this->payload = $userPodcast->save();
    }
}
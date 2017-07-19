<?php


namespace App\Actions\Misc;

use App\Lib\Helpers\Config;
use App\Lib\Slime\RestAction\ApiAction;

use App\Models\Misc\LogAction;

class StatsPush extends ApiAction
{
    protected function performAction()
    {
        if (Config::get('app.logActions')) {
            $body = $this->getJsonRequestBody();
            $stats = array_merge(
                $body,
                [
                    'ip' => $this->request->getAttribute('ip_address')
                ]
            );
            LogAction::create(
                $stats
            );
        }

        $this->payload = true;
    }
}
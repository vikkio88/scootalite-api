<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Models\Users\Auth\SocialProvider;

class S1489781346SocialProvider implements DbHelperInterface
{

    public function run()
    {
        $socialProviders = [
            'facebook'
        ];

        foreach ($socialProviders as $provider) {
            SocialProvider::create(
                ['name' => $provider]
            );
        }
    }

}
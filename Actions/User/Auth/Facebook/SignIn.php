<?php

namespace App\Actions\User\Auth\Facebook;

use App\Lib\Helpers\Config;
use App\Lib\Helpers\JwtHelper;
use App\Lib\Helpers\TokenHelper;
use App\Lib\Slime\Exceptions\Http\UnAuthorizedException;
use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Users\Auth\SocialProvider;
use App\Models\Users\Auth\UserSocialProvider;
use App\Models\Users\User;
use Exception;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Facebook;

class SignIn extends ApiAction
{
    protected $providerName = 'facebook';

    protected function performAction()
    {
        $config = Config::get('authProvider.facebook');
        $fb = new Facebook([
            'app_id' => $config['id'],
            'app_secret' => $config['secret'],
            'default_graph_version' => 'v2.5',
        ]);
        $authToken = $this->getJsonRequestBody()['auth'];
        try {
            $response = $fb->get('/me?fields=name,email', $authToken);
            $this->payload = $this->signIn(
                json_decode($response->getBody(), true)
            );
        } catch (FacebookResponseException $e) {
            throw new UnAuthorizedException($e->getMessage());
        }
    }

    protected function signIn($providerUser)
    {
        $socialProvider = SocialProvider::where('name', $this->providerName)->first();
        if (empty($socialProvider)) {
            throw new Exception('Internal Auth Error');
        }
        $localUser = UserSocialProvider::where(
            [
                'provider_user_id' => $providerUser['id'],
                'social_provider_id' => $socialProvider->id
            ]
        )->first();

        $localUserId = empty($localUser) ? null : $localUser->user_id;
        // TODO: check if the user was already there with the email but a different social
        if (empty($localUserId)) {
            $localUser = User::create(
                [
                    'name' => $providerUser['name'],
                    'username' => $providerUser['email'],
                    'email' => $providerUser['email']
                ]
            );

            UserSocialProvider::create(
                [
                    'user_id' => $localUser->id,
                    'social_provider_id' => $socialProvider->id,
                    'provider_user_id' => $providerUser['id'],
                ]
            );
            $localUserId = $localUser->id;
        }

        return [
            'token' => JwtHelper::encode(
                TokenHelper::getTokenPayload($localUserId)
            )
        ];

    }
}
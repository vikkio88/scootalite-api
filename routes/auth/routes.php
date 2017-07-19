<?php

use App\Actions\User\Auth\Facebook\SignIn as FacebookSignIn;
use App\Actions\User\Auth\LoginToken;

$api->post('/auth/facebook', FacebookSignIn::class);

$api->get('/auth/{token}', LoginToken::class);
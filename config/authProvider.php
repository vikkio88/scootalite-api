<?php

$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
try {
    $dotenv->load();
} catch (Exception $e) {
    //yummy exception
}

return [
    'facebook' => [
        'id' => getenv('FACEBOOK_APP_ID'),
        'secret' => getenv('FACEBOOK_APP_SECRET')
    ]
];

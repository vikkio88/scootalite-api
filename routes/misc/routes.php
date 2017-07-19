<?php

use App\Actions\Misc\LanguagesGetAll;

$api->get('/misc/languages', LanguagesGetAll::class);
<?php
use App\Actions\User\LoggedIn\FavouriteShowAdd;
use App\Actions\User\LoggedIn\FavouriteShowDelete;
use App\Actions\User\LoggedIn\MyInfoGet;
use App\Actions\User\LoggedIn\MyPositionSave;

$api->get('/me', MyInfoGet::class);

$api->put('/me/position', MyPositionSave::class);

$api->post('/me/favourites/shows', FavouriteShowAdd::class);
$api->delete('/me/favourites/shows/{showId}', FavouriteShowDelete::class);

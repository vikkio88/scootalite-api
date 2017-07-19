<?php

use App\Actions\Podcast\ShowGetAll;
use App\Actions\Podcast\ShowGetOneBySlug;
use App\Actions\Podcast\ShowGetPodcasts;
use App\Actions\Podcast\ParseFromFeedUrl;

$api->get('/shows', ShowGetAll::class);

$api->post('/shows/parse', ParseFromFeedUrl::class);

$api->get('/shows/{slug}', ShowGetOneBySlug::class);

$api->get('/shows/{showId}/podcasts', ShowGetPodcasts::class);

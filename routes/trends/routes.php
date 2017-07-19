<?php

use App\Actions\Podcast\PodcastsGetLatest;
use App\Actions\Podcast\ShowGetTrends;

$api->get('/trends/shows', ShowGetTrends::class);

$api->get('/trends/podcasts/latest', PodcastsGetLatest::class);
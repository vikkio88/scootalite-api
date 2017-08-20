<?php

use App\Actions\Podcast\PodcastGetOne;

$api->get('/podcasts/{slug}', PodcastGetOne::class);

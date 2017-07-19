<?php

use App\Actions\Podcast\PodcastGetOne;

$api->get('/podcasts/{id}', PodcastGetOne::class);

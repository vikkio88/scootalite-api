<?php

use App\Actions\Misc\StatsPush;

$api->post('/stats', StatsPush::class);

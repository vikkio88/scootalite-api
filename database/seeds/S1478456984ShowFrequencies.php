<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Models\Podcasts\ShowFrequency;

class S1478456984ShowFrequencies implements DbHelperInterface
{

    public function run()
    {

        $frequencies = [
            'hourly' => '+1 hours',
            'daily' => '+1 days',
            'weekly' => '+7 days',
        ];

        foreach ($frequencies as $frequency => $timeDiff) {
            ShowFrequency::create(
                [
                    'name' => $frequency,
                    'time_diff' => $timeDiff
                ]
            );
        }

    }

}
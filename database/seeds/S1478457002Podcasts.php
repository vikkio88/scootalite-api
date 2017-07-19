<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Models\Podcasts\Show;

class S1478457002Podcasts implements DbHelperInterface
{

    public function run()
    {
        $faker = Faker\Factory::create();
        $radioShows = Show::all();

        $totalNumber = 1;
        foreach ($radioShows as $radioShow) {
            $podcast = rand(1, 20);
            foreach (range(1, $podcast) as $index) {
                \App\Models\Podcasts\Podcast::create(
                    [
                        'name' => $faker->text(rand(6, 100)),
                        'description' => $faker->text(rand(10, 100)),
                        'duration' => sprintf("00:%d:%d", rand(10, 60), rand(10, 60)),
                        'previous_podcast_id' => $this->getRandomPrevious($totalNumber, $index),
                        'next_podcast_id' => $this->getRandomNext($totalNumber, $index, $podcast),
                        'date' => $faker->dateTime,
                        'file_url' => $faker->url . '/' . str_random(10) . '.mp3',
                        'radio_show_id' => $radioShow->id
                    ]
                );
                $totalNumber++;
            }
        }

    }

    private function getRandomPrevious($total, $index)
    {
        if ($index < 2) {
            return null;
        }

        return (rand(0, 100) > 50 && $total > 1) ? ($total - 1) : null;
    }

    private function getRandomNext($total, $index, $podcasts)
    {
        if ($index >= $podcasts) {
            return null;
        }

        return rand(0, 100) > 50 ? ($total + 1) : null;
    }


}
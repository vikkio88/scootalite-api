<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Models\Misc\Language;
use App\Models\Podcasts\Radio;
use App\Models\Podcasts\Show;
use App\Models\Podcasts\ShowFrequency;

class S1478456992Shows implements DbHelperInterface
{

    public function run()
    {
        $faker = Faker\Factory::create();
        $showsNumber = 10;
        foreach (range(0, $showsNumber) as $_) {
            $name = $faker->company . rand(1, 5);
            Show::create(
                [
                    'name' => $name,
                    'author' => $faker->name(),
                    'description' => $faker->text(rand(6, 100)),
                    'slug' => strtolower(str_replace(' ', '-', $name)),
                    'language_id' => Language::all()->random()->id,
                    'website' => $faker->url,
                    'feed_url' => $faker->url . '/feed.xml',
                    'logo_url' => $faker->imageUrl(200, 200),
                    'frequency_id' => ShowFrequency::all()->random()->id
                ]
            );
        }
    }

}
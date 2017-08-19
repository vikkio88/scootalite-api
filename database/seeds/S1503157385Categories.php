<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Models\Podcasts\Category;

class S1503157385Categories implements DbHelperInterface
{
    public function run()
    {
        $categories = [
            'Programming',
            'Entertainment',
            'Sport'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }

    }
}
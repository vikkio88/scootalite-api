<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Models\Misc\Language;

class S1478388654Languages implements DbHelperInterface
{

    public function run()
    {
        $languages = [
            [
                'iso' => 'it',
                'name' => 'Italian'
            ],
            [
                'iso' => 'de',
                'name' => 'German'
            ],
            [
                'iso' => 'gb',
                'name' => 'British English'
            ],
            [
                'iso' => 'us',
                'name' => 'USA'
            ],
            [
                'iso' => 'fr',
                'name' => 'French'
            ],
            [
                'iso' => 'es',
                'name' => 'Spanish'
            ]
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }

    }

}
<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Models\Users\User;

class S1477152730UsersSeeder implements DbHelperInterface
{

    public function run()
    {
        $faker = Faker\Factory::create();
        $usersNumber = 10;
        for ($i = 1; $i <= $usersNumber; $i++) {
            User::create(
                [
                    'name' => $faker->name,
                    'username' => $faker->userName,
                    'email' => $faker->email,
                ]
            );
        }
    }

}
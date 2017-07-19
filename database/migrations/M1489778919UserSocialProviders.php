<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1489778919UserSocialProviders implements DbHelperInterface
{

    public function run()
    {
        $tableName = 'user_social_providers';
        Capsule::schema()->dropIfExists($tableName);
        Capsule::schema()->create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->string('provider_user_id')->index();
            $table->integer('social_provider_id')->index()->unsigned();
            $table->timestamps();
        });
    }

}
<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1478450958UserActivePodcasts implements DbHelperInterface
{

    public function run()
    {
        $tableName = 'user_active_podcasts';
        Capsule::schema()->dropIfExists($tableName);
        Capsule::schema()->create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->integer('podcast_id')->index()->unsigned();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
            $table->unique('user_id');
        });
    }

}
<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1478449937Podcasts implements DbHelperInterface
{

    public function run()
    {
        $tableName = 'podcasts';
        Capsule::schema()->dropIfExists($tableName);
        Capsule::schema()->create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->index()->unique();
            $table->string('name');
            $table->longText('description', 150)->nullable();
            $table->string('duration', 20)->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('show_id')->index()->unsigned()->nullable();
            $table->integer('next_podcast_id')->index()->unsigned()->nullable();
            $table->integer('previous_podcast_id')->index()->unsigned()->nullable();
            $table->string('file_url')->nullable();
            $table->timestamps();
        });
    }

}
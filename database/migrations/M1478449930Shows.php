<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1478449930Shows implements DbHelperInterface
{

    public function run()
    {
        $tableName = 'shows';
        Capsule::schema()->dropIfExists($tableName);
        Capsule::schema()->create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index()->unique();
            $table->longText('description')->nullable();
            $table->string('author')->nullable();
            $table->boolean('explicit')->default(false);
            $table->integer('language_id')->nullable();
            $table->string('website')->nullable();
            $table->string('feed_url')->index();
            $table->string('logo_url')->nullable();
            $table->smallInteger('valid_for')->default(12);
            $table->timestamps();
        });
    }

}
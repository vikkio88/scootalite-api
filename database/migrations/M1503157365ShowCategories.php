<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1503157365ShowCategories implements DbHelperInterface
{

    public function run()
    {
        $tableName = 'show_categories';
        Capsule::schema()->dropIfExists($tableName);
        Capsule::schema()->create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('show_id')->index()->unsigned();
            $table->integer('category_id')->index()->unsigned();
            $table->timestamps();
        });
    }

}
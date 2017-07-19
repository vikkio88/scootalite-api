<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule; 
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1483878234LogActions implements DbHelperInterface {

        public function run()
        {
        $tableName = 'log_actions';
        Capsule::schema()->dropIfExists($tableName);
        Capsule::schema()->create($tableName, function (Blueprint $table) {
            $table->string('navigator')->nullable();
            $table->string('ip');
            $table->string('action')->nullable();
            $table->timestamps();
        });
        }
        
}
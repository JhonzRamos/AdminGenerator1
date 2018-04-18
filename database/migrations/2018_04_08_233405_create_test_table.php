<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateTestTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('test',function(Blueprint $table){
            $table->increments("id");
            $table->enum("sClassification", ["enum1", "enum2", "enum3", ])->nullable();
            $table->string("sTitle");
            $table->string("bRadio")->nullable();
            $table->tinyInteger("bCheck")->default(0)->nullable();
            $table->decimal("fMoney", 15, 2)->nullable();
            $table->date("iDateEntry")->nullable();
            $table->string("sEmail")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('test');
    }

}
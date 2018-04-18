<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateAllMenusTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('allmenus',function(Blueprint $table){
            $table->increments("id");
            $table->string("sTitle")->nullable();
            $table->string("sEmail")->nullable();
            $table->integer("sNUmber")->nullable();
            $table->text("sLocation")->nullable();
            $table->string("sColor")->nullable();
            $table->text("iTime")->nullable();
            $table->string("sToggle")->nullable();
            $table->integer("books_id")->references("id")->on("books")->nullable();
            $table->text("sT")->nullable();
            $table->text("sSFa")->nullable();
            $table->string("sRadio")->nullable();
            $table->tinyInteger("bCheckBox")->default(0)->nullable();
            $table->date("bDatePicker")->nullable();
            $table->dateTime("bDateTimePicker")->nullable();
            $table->integer("user_id")->references("id")->on("user")->nullable();
            $table->string("sFile")->nullable();
            $table->string("sPhoto")->nullable();
            $table->string("sPassword")->nullable();
            $table->decimal("dMoney", 15, 2)->nullable();
            $table->enum("sEnum", ["small", "medium", "large", ])->nullable();
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
        Schema::drop('allmenus');
    }

}
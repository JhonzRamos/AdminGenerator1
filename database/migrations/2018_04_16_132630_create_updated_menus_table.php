<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateUpdatedMenusTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('updatedmenus',function(Blueprint $table){
            $table->increments("id");
            $table->string("sTitle")->nullable();
            $table->string("sEmail")->nullable();
            $table->integer("iNumber")->nullable();
            $table->text("sLocation")->nullable();
            $table->string("sColor")->nullable();
            $table->text("iTime")->nullable();
            $table->string("bToggle")->nullable();
            $table->integer("books_id")->references("id")->on("books")->nullable();
            $table->text("sMCE")->nullable();
            $table->text("sNoMCE")->nullable();
            $table->string("bRadio")->nullable();
            $table->tinyInteger("bCheckBox")->default(1)->nullable();
            $table->date("iDAtePicker")->nullable();
            $table->dateTime("iDateTime")->nullable();
            $table->integer("user_id")->references("id")->on("user")->nullable();
            $table->string("sFileUpload")->nullable();
            $table->string("sPhoto")->nullable();
            $table->string("sPassword")->nullable();
            $table->decimal("dMoney", 15, 2)->nullable();
            $table->enum("aEnum", ["small", "medium", "large", ])->nullable();
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
        Schema::drop('updatedmenus');
    }

}
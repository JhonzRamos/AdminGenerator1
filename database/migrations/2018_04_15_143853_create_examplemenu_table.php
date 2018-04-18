<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateExampleMenuTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('examplemenu',function(Blueprint $table){
            $table->increments("id");
            $table->string("sPhoto");
            $table->text("sLocation");
            $table->string("bToggle");
            $table->text("sDesc");
            $table->text("sDesc2");
            $table->string("sFile");
            $table->enum("oEnum", ["small", "medium", "large", ]);
            $table->string("sPassword");
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
        Schema::drop('examplemenu');
    }

}
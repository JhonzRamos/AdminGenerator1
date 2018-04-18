<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateFavorites14Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('favorites14', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('favorites14_books',function(Blueprint $table){
            $table->increments("id");
            $table->integer("favorites14_id")->unsigned()->index();
            $table->foreign("favorites14_id")->references("id")->on("favorites")->onDelete("cascade");
            $table->integer("books_id")->unsigned()->index();
            $table->foreign("books_id")->references("id")->on("books")->onDelete("cascade");
            $table->unique(["favorites14_id","books_id"]);
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
        Schema::drop('favorites14_books');
        Schema::table('favorites14', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
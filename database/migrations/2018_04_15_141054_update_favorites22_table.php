<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateFavorites22Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('favorites22', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('favorites22_books',function(Blueprint $table){
            $table->integer("favorites22_id")->unsigned()->index();
            $table->foreign("favorites22_id")->references("id")->on("favorites22")->onDelete("cascade");
            $table->integer("books_id")->unsigned()->index();
            $table->foreign("books_id")->references("id")->on("books")->onDelete("cascade");
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
        Schema::drop('favorites22_books');
        Schema::table('favorites22', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateFavorite24Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('favorite24', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('favorite24_books',function(Blueprint $table){
            $table->integer("favorite24_id")->unsigned()->index();
            $table->foreign("favorite24_id")->references("id")->on("favorite24")->onDelete("cascade");
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
        Schema::drop('favorite24_books');
        Schema::table('favorite24', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
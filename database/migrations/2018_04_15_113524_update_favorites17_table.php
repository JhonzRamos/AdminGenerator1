<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateFavorites17Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('favorites17', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('favorites17_books',function(Blueprint $table){
                        $table->integer("favorites17_id")->unsigned()->index();
            $table->integer("books_id")->unsigned()->index();
            $table->unique(["favorites17_id","books_id"]);
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
        Schema::drop('favorites17_books');
        Schema::table('favorites17', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
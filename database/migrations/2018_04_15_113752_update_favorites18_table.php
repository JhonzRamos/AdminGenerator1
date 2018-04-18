<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateFavorites18Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('favorites18', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('favorites18_books',function(Blueprint $table){
                        $table->integer("favorites18_id")->unsigned()->index();
            $table->integer("books_id")->unsigned()->index();
            $table->unique(["favorites18_id","books_id"]);
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
        Schema::drop('favorites18_books');
        Schema::table('favorites18', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
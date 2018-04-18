<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateFavorites12Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('favorites12', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('favorites12_books',function(Blueprint $table){
            $table->increments("id");
            $table->integer("favorites12_id")->unsigned()->index();
            $table->foreign("favorites12_id")->references("id")->on("favorites")->onDelete("cascade");
            $table->integer("books_id")->unsigned()->index();
            $table->foreign("books_id")->references("id")->on("books")->onDelete("cascade");
$table->unique(["favorites12_id","books_id"]);
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
        Schema::drop('favorites12_books');
        Schema::table('favorites12', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
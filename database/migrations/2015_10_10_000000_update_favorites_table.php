<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropColumn('books_id')->nullable();
        });
        Schema::create('favorites_books', function (Blueprint $table) {
            $table->integer('favorites_id')->unsigned()->index();
            $table->foreign('favorites_id')->references('id')->on('favorites')->onDelete('cascade');
            $table->integer('books_id')->unsigned()->index();
            $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade');
            $table->unique(['favorites_id', 'books_id']);
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
        Schema::drop('favorites_books');
        Schema::table('favorites', function (Blueprint $table) {
            $table->string('books_id')->nullable()->after('id');
        });
    }
}
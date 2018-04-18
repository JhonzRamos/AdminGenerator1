<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateAllMenusTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('allmenus', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('allmenus_books',function(Blueprint $table){
            $table->integer("allmenus_id")->unsigned()->index();
            $table->foreign("allmenus_id")->references("id")->on("allmenus")->onDelete("cascade");
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
        Schema::drop('allmenus_books');
        Schema::table('allmenus', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
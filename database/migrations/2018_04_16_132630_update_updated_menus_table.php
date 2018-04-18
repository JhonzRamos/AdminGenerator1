<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateUpdatedMenusTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::table('updatedmenus', function (Blueprint $table) {
           $table->dropColumn('books_id')->nullable();
        });
        Schema::create('updatedmenus_books',function(Blueprint $table){
            $table->integer("updatedmenus_id")->unsigned()->index();
            $table->foreign("updatedmenus_id")->references("id")->on("updatedmenus")->onDelete("cascade");
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
        Schema::drop('updatedmenus_books');
        Schema::table('updatedmenus', function (Blueprint $table) {
                    $table->string('books_id')->nullable()->after('id');
        });
    }

}
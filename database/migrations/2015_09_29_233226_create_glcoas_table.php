<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlcoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glcoas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('acct');
            $table->string('title');
            $table->decimal('init', 2);
            $table->timestamps();
        });

        /**
         * When an account is deleted then all of its
         * transactions will also be deleted.
         */
        $table->foreign('acct')
            ->references('acct')
            ->on('gltrns')
            ->onDelete('cascade');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('glcoas');
    }
}

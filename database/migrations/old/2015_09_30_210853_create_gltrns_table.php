<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGltrnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gltrns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('acct');
            $table->string('description');
            $table->string('crj');
            $table->date('date');
            $table->string('document');
            $table->decimal('amount', 14, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gltrns');
    }
}

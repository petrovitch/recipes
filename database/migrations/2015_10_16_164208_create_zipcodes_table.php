<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-16 16:42:08
// ------------------------------------------------------------

class CreateZipcodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('zipcodes', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('city', 255)->nullable();
			$table->string('state', 255)->nullable();
			$table->string('state_name', 255)->nullable();
			$table->unsignedInteger('zipcode')->unsigned();
			$table->string('county', 255)->nullable();
			$table->string('country', 255)->nullable();
			$table->string('lat', 255)->nullable();
			$table->string('lon', 255)->nullable();
			$table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
			$table->timestamp('updated_at')->default("0000-00-00 00:00:00");
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down()
	{
		Schema::drop('zipcodes');
	}
}
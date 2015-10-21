<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateCountiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('counties', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->unsignedInteger('state_id');
			$table->unsignedInteger('location_id');
			$table->string('county', 255);
			$table->string('label', 255)->unique();
			$table->string('locale', 255)->unique();
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
		Schema::drop('counties');
	}
}
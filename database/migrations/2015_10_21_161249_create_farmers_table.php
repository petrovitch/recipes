<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateFarmersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('farmers', function(Blueprint $table) {
			$table->unsignedInteger('id')->unsigned();
			$table->string('farmer', 40)->nullable();
			$table->string('street', 40)->nullable();
			$table->string('city', 40)->nullable();
			$table->string('state', 2)->nullable();
			$table->string('zip', 5)->nullable();
			$table->timestamp('created_at')->default("0000-00-00 00:00:00");
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
		Schema::drop('farmers');
	}
}
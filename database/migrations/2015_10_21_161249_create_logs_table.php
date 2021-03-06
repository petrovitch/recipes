<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('logs', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->unsignedInteger('user_id')->nullable();
			$table->string('owner_type', 255);
			$table->unsignedInteger('owner_id');
			$table->text('old_value')->nullable();
			$table->text('new_value')->nullable();
			$table->string('type', 255);
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
		Schema::drop('logs');
	}
}
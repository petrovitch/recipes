<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-16 16:42:08
// ------------------------------------------------------------

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('name', 255);
			$table->string('email', 255)->unique();
			$table->string('password', 60);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}
}
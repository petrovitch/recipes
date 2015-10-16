<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-16 16:42:08
// ------------------------------------------------------------

class CreatePermissionRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('permission_role', function(Blueprint $table) {
			$table->increments('permission_id')->unsigned();
			$table->increments('role_id')->unsigned();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down()
	{
		Schema::drop('permission_role');
	}
}
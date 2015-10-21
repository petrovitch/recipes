<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateMccMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('mcc_members', function(Blueprint $table) {
			$table->unsignedInteger('id')->unsigned();
			$table->string('username', 20)->nullable();
			$table->string('password', 20)->nullable();
			$table->string('name', 80)->nullable();
			$table->string('zip', 5)->nullable();
			$table->string('uscf_id', 20)->nullable();
			$table->unsignedInteger('uscf_rating')->nullable()->unsigned();
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
		Schema::drop('mcc_members');
	}
}
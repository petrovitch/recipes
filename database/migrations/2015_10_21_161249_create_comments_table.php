<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->text('content');
			$table->unsignedInteger('post_id');
			$table->unsignedInteger('user_id');
			$table->boolean('status')->default("1");
			$table->timestamp('created_at')->default("0000-00-00 00:00:00");
			$table->timestamp('updated_at')->default("0000-00-00 00:00:00");
			$table->string('post_type', 255)->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down()
	{
		Schema::drop('comments');
	}
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-11 00:00:05
// ------------------------------------------------------------

class CreateCategoryPostForeignTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
Schema::table('category_post', function($table) {
			$table->foreign('post_id')->references('id')->on('posts');
			$table->foreign('category_id')->references('id')->on('categories');
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
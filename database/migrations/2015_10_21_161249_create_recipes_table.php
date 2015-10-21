<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('recipes', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('category', 20)->nullable();
			$table->string('name', 50)->nullable();
			$table->string('author', 40)->nullable();
			$table->text('recipe')->nullable();
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
		Schema::drop('recipes');
	}
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-15 16:59:31
// ------------------------------------------------------------

class CreateCommoditiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('commodities', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('commodity', 40)->nullable();
			$table->string('abbr', 2)->nullable();
			$table->unsignedInteger('test_weight')->nullable()->unsigned();
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
		Schema::drop('commodities');
	}
}
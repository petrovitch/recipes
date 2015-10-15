<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-15 16:59:31
// ------------------------------------------------------------

class CreateMccQuotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('mcc_quotes', function(Blueprint $table) {
			$table->unsignedInteger('keyid')->unsigned();
			$table->string('quote', 255)->nullable();
			$table->string('author', 255)->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down()
	{
		Schema::drop('mcc_quotes');
	}
}
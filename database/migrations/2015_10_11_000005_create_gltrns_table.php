<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-11 00:00:05
// ------------------------------------------------------------

class CreateGltrnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('gltrns', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('acct', 8)->nullable();
			$table->string('description', 255)->nullable();
			$table->string('crj', 3)->nullable();
			$table->date('date')->nullable();
			$table->string('document', 20)->nullable();
			$table->decimal('amount', 14,2)->nullable();
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
		Schema::drop('gltrns');
	}
}
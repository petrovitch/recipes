<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateMccEcosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('mcc_ecos', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('eco', 3)->nullable();
			$table->string('opening', 255)->nullable();
			$table->text('moves')->nullable();
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
		Schema::drop('mcc_ecos');
	}
}
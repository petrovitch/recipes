<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-16 16:42:08
// ------------------------------------------------------------

class CreateOutboundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('outbounds', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->unsignedInteger('ticket')->nullable()->unsigned();
			$table->date('delivery_date')->nullable();
			$table->('delivery_time')->nullable();
			$table->unsignedInteger('consignee')->nullable()->unsigned();
			$table->unsignedInteger('commodity')->nullable()->unsigned();
			$table->unsignedInteger('gross')->nullable()->unsigned();
			$table->unsignedInteger('tare')->nullable()->unsigned();
			$table->unsignedInteger('net')->nullable()->unsigned();
			$table->unsignedInteger('bushel_weight')->nullable()->unsigned();
			$table->decimal('bushels', 14,2)->nullable();
			$table->boolean('is_driver')->nullable();
			$table->string('truck_id', 20)->nullable();
			$table->string('trucking_company', 40)->nullable();
			$table->string('driver', 40)->nullable();
			$table->string('trailer_license', 20)->nullable();
			$table->decimal('test_weight', 8,2)->nullable();
			$table->decimal('base_price', 8,4)->nullable();
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
		Schema::drop('outbounds');
	}
}
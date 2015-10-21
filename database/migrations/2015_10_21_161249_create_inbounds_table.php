<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-21 16:12:49
// ------------------------------------------------------------

class CreateInboundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('inbounds', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->unsignedInteger('ticket')->nullable()->unsigned();
			$table->date('delivery_date')->nullable();
			$table->('delivery_time')->nullable();
			$table->unsignedInteger('producer')->nullable()->unsigned();
			$table->unsignedInteger('commodity')->nullable()->unsigned();
			$table->unsignedInteger('gross')->nullable()->unsigned();
			$table->unsignedInteger('tare')->nullable()->unsigned();
			$table->unsignedInteger('net')->nullable()->unsigned();
			$table->unsignedInteger('bushel_weight')->nullable()->unsigned();
			$table->decimal('bushels', 14,2)->nullable();
			$table->boolean('driver_on')->nullable();
			$table->string('truck_id', 20)->nullable();
			$table->string('trucking_company', 40)->nullable();
			$table->string('driver', 40)->nullable();
			$table->string('trailer_license', 20)->nullable();
			$table->string('grade', 8)->nullable();
			$table->decimal('moisture', 8,2)->nullable();
			$table->decimal('test_weight', 8,2)->nullable();
			$table->decimal('damage', 8,2)->nullable();
			$table->decimal('heat_damage', 8,2)->nullable();
			$table->decimal('fm', 8,2)->nullable();
			$table->decimal('splits', 8,2)->nullable();
			$table->decimal('other', 8,2)->nullable();
			$table->decimal('base_price', 8,4)->nullable();
			$table->decimal('total_disc', 8,4)->nullable();
			$table->decimal('net_price', 8,4)->nullable();
			$table->string('reason_for_rejection', 255)->nullable();
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
		Schema::drop('inbounds');
	}
}
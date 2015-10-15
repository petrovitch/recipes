<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2015-10-15 16:59:31
// ------------------------------------------------------------

class CreateMccArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('mcc_articles', function(Blueprint $table) {
			$table->unsignedInteger('keyid')->unsigned();
			$table->unsignedInteger('category')->unsigned();
			$table->string('author', 255)->nullable();
			$table->string('photo', 255)->nullable();
			$table->string('title', 255)->nullable();
			$table->text('body')->nullable();
			$table->unsignedInteger('groupId')->nullable()->unsigned();
			$table->unsignedInteger('level')->nullable()->unsigned();
			$table->unsignedInteger('rank')->nullable()->unsigned();
			$table->text('quote')->nullable();
			$table->text('reference')->nullable();
			$table->text('checkmate_analysis')->nullable();
			$table->text('solution')->nullable();
			$table->text('variations')->nullable();
			$table->text('comments')->nullable();
			$table->unsignedInteger('unproven')->nullable()->unsigned();
			$table->unsignedInteger('theme')->nullable()->unsigned();
			$table->text('fen')->nullable();
			$table->unsignedInteger('color_to_move')->nullable()->unsigned();
			$table->text('fens')->nullable();
			$table->text('points')->nullable();
			$table->text('caption')->nullable();
			$table->text('pgn')->nullable();
			$table->text('fritz')->nullable();
			$table->text('crafty')->nullable();
			$table->text('commentary')->nullable();
			$table->text('moves')->nullable();
			$table->string('moves_str', 255)->nullable();
			$table->unsignedInteger('moveCount')->nullable()->unsigned();
			$table->string('event', 255)->nullable();
			$table->string('site', 255)->nullable();
			$table->date('gameDate')->nullable();
			$table->unsignedInteger('gameRound')->nullable()->unsigned();
			$table->string('white', 255)->nullable();
			$table->string('black', 255)->nullable();
			$table->string('gameResult', 255)->nullable();
			$table->string('eco', 255)->nullable();
			$table->unsignedInteger('whiteElo')->nullable()->unsigned();
			$table->unsignedInteger('blackElo')->nullable()->unsigned();
			$table->string('opening', 255)->nullable();
			$table->unsignedInteger('year')->nullable()->unsigned();
			$table->string('image', 255)->nullable();
			$table->text('video')->nullable();
			$table->string('url', 255)->nullable();
			$table->string('email', 255)->nullable();
			$table->string('telephone', 255)->nullable();
			$table->unsignedInteger('stars')->nullable()->unsigned();
			$table->unsignedInteger('calendar')->nullable()->unsigned();
			$table->unsignedInteger('priority')->nullable()->unsigned();
			$table->unsignedInteger('featured')->nullable()->unsigned();
			$table->unsignedInteger('openingTheory')->nullable()->unsigned();
			$table->unsignedInteger('miniature')->nullable()->unsigned();
			$table->unsignedInteger('middlegame')->nullable()->unsigned();
			$table->unsignedInteger('materialGain')->nullable()->unsigned();
			$table->unsignedInteger('endgame')->nullable()->unsigned();
			$table->unsignedInteger('checkmate')->nullable()->unsigned();
			$table->unsignedInteger('checkmate_in_n')->nullable()->unsigned();
			$table->unsignedInteger('composition')->nullable()->unsigned();
			$table->unsignedInteger('conditional')->nullable()->unsigned();
			$table->unsignedInteger('bad')->nullable()->unsigned();
			$table->unsignedInteger('memorial')->nullable()->unsigned();
			$table->unsignedInteger('book')->nullable()->unsigned();
			$table->unsignedInteger('bookNumber')->nullable()->unsigned();
			$table->string('isbn', 255)->nullable();
			$table->unsignedInteger('problem_number')->nullable()->unsigned();
			$table->unsignedInteger('authorized')->nullable()->unsigned();
			$table->unsignedInteger('validated')->nullable()->unsigned();
			$table->date('yyyymmdd')->nullable();
			$table->string('day_of_week', 255)->nullable();
			$table->unsignedInteger('hits')->nullable()->unsigned();
			$table->date('created')->nullable();
			$table->date('modified')->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down()
	{
		Schema::drop('mcc_articles');
	}
}
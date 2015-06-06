<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('board_members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('year');
			$table->string('position');
			$table->string('image_url');
         	$table->text('description');
			$table->string('twitter_link');
			$table->string('facebook_link');
			$table->integer('sort_order');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('board_members');
	}

}

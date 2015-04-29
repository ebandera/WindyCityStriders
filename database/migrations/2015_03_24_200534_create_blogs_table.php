<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blogs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('event_id')->unsigned()->nullable();
			$table->integer('page_id')->unsigned();
			$table->string('blog_level');
			$table->integer('blog_id')->unsigned()->nullable();
			$table->string('heading');
			$table->text('html_text');
			$table->string('image_url');
			$table->string('image_position');
			$table->dateTime('expiration_date');
			$table->integer('sort_order');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('blogs');
	}

}

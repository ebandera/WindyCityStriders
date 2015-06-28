<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamp('event_date');
			$table->string('event_name');
			$table->string('event_img_url');
			$table->string('event_place_text');
			$table->string('event_address');
			$table->string('event_details');
			$table->string('event_info_path');
            $table->string('event_url_path');
			$table->string('event_results_path');
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
		Schema::drop('events');
	}

}

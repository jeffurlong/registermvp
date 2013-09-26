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
			$table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
			$table->integer('event_series_id')->unsigned();
			$table->string('name');
			$table->text('description');
			$table->decimal('cost', 12, 4);
			$table->smallInteger('capacity');
			$table->string('has_wait_list', 1);
			$table->string('has_teams', 1);
			$table->smallInteger('display_order');
			$table->date('start_dt');
			$table->date('end_dt');
			$table->date('reg_start_dt');
			$table->date('reg_end_dt');
			$table->timestamps();
			$table->softDeletes();

			$table->index('event_series_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('events')) {
			Schema::drop('events');
		}
	}

}

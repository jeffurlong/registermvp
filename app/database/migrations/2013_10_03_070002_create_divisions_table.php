<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('divisions', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
			$table->integer('season_id')->unsigned();
			$table->string('name');
			$table->text('description');
			$table->boolean('has_teams')->default(true);
			$table->smallInteger('display_order');
			$table->date('start_dt');
			$table->date('end_dt');
			$table->date('reg_start_dt');
			$table->date('reg_end_dt');
			$table->timestamps();
			$table->softDeletes();

			$table->index('season_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('divisions')) {
			Schema::drop('divisions');
		}
	}

}

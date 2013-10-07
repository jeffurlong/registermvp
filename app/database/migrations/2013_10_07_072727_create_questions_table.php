<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
			$table->integer('season_id')->unsigned();
			$table->string('question_text');
			$table->enum('question_type', array('line', 'paragraph', 'select', 'multiselect'));

			$table->text('responses')->nullable();

			$table->boolean('response_required')->default(false);
			$table->smallInteger('display_order');
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
		if (Schema::hasTable('questions')) {
			Schema::drop('questions');
		}
	}

}

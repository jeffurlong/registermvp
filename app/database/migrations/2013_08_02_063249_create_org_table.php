<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('org', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

			$table->string('k')->unique();
			$table->text('v')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('org')) {
			Schema::drop('org');
		}
	}

}

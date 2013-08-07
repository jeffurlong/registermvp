<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('master_id')->unsigned()->nullable();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('phone');
			$table->string('gender', 1)->nullable();
			$table->date('dob')->nullable();
			$table->string('emergency_name');
			$table->string('emergency_phone');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('people');
	}

}

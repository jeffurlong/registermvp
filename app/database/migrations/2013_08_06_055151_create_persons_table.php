<?php

use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persons', function(Blueprint $table)
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
		Schema::drop('persons');
	}

}

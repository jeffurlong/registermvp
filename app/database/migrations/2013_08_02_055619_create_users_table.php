<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
			$table->integer('person_id')->unsigned();
			$table->smallInteger('role_id')->unsigned()->default(1);
			$table->string('username');
			$table->string('password');
			$table->timestamps();
			$table->softDeletes();

			$table->index('person_id');
			$table->index('role_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('users')) {
			Schema::drop('users');
		}
	}

}

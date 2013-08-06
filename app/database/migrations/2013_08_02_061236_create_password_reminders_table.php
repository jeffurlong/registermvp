<?php

use Illuminate\Database\Migrations\Migration;

class CreatePasswordRemindersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('password_reminders', function($t)
		{
			$t->string('email');
			$t->string('token');
			$t->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::has_table('password_reminders')) {
			Schema::drop('password_reminders');
		}
	}

}

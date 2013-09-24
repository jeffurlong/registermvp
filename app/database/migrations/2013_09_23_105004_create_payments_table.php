<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->string('transaction_id');
			$table->string('authorization_id');
			$table->decimal('amount', 12, 4);
			$table->string('method');
			$table->string('cc_type');
			$table->string('cc_number');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('remote_ip');
			$table->timestamps();
			$table->softDeletes();

			$table->index('order_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('payments')) {
			Schema::drop('payments');
		}
	}

}

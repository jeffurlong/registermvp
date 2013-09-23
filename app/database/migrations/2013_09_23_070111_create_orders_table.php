<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
			$table->integer('person_id')->unsigned();
			$table->string('name');
			$table->string('email');
			$table->decimal('amount', 12, 4);
			$table->string('remote_ip');
			$table->timestamps();
			$table->softDeletes();

			$table->index('person_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('orders')) {
			Schema::drop('orders');
		}
	}

}

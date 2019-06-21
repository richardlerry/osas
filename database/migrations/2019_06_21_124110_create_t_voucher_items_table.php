<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTVoucherItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_voucher_items', function(Blueprint $table)
		{
			$table->increments('vouchI_id');
			$table->integer('vouch_id')->unsigned()->index('vouch_id');
			$table->string('itemName', 100);
			$table->float('amount', 10)->default(0.00);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_voucher_items');
	}

}

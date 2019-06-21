<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTVoucherItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_voucher_items', function(Blueprint $table)
		{
			$table->foreign('vouch_id', 't_voucher_items_ibfk_1')->references('vouch_id')->on('r_vouchers')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_voucher_items', function(Blueprint $table)
		{
			$table->dropForeign('t_voucher_items_ibfk_1');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('r_vouchers', function(Blueprint $table)
		{
			$table->foreign('org_id', 'r_vouchers_ibfk_1')->references('org_id')->on('r_organization_profiles')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('r_vouchers', function(Blueprint $table)
		{
			$table->dropForeign('r_vouchers_ibfk_1');
		});
	}

}

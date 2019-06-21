<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTOrgLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_org_ledgers', function(Blueprint $table)
		{
			$table->foreign('org_id', 't_org_ledgers_ibfk_1')->references('org_id')->on('r_organization_profiles')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_org_ledgers', function(Blueprint $table)
		{
			$table->dropForeign('t_org_ledgers_ibfk_1');
		});
	}

}

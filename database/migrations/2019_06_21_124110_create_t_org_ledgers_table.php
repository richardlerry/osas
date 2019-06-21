<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTOrgLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_org_ledgers', function(Blueprint $table)
		{
			$table->increments('orgL_id');
			$table->integer('org_id')->unsigned()->index('org_id');
			$table->float('amount', 10)->default(0.00);
			$table->integer('ref_id')->unsigned();
			$table->string('type', 20);
			$table->boolean('stat')->default(1);
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
		Schema::drop('t_org_ledgers');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTFinancialAssistancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_financial_assistances', function(Blueprint $table)
		{
			$table->increments('finA_id');
			$table->integer('finT_id')->unsigned()->index('finT_id');
			$table->integer('studP_id')->unsigned()->index('studP_id');
			$table->string('finStatus', 100);
			$table->string('remarks', 100)->nullable();
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
		Schema::drop('t_financial_assistances');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTFinancialAssistancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_financial_assistances', function(Blueprint $table)
		{
			$table->foreign('studP_id', 't_financial_assistances_ibfk_1')->references('studP_id')->on('r_student_profiles')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('finT_id', 't_financial_assistances_ibfk_2')->references('finT_id')->on('r_financial_titles')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_financial_assistances', function(Blueprint $table)
		{
			$table->dropForeign('t_financial_assistances_ibfk_1');
			$table->dropForeign('t_financial_assistances_ibfk_2');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTSanctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t_sanctions', function(Blueprint $table)
		{
			$table->foreign('studP_id', 't_sanctions_ibfk_1')->references('studP_id')->on('r_student_profiles')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('sancT_id', 't_sanctions_ibfk_2')->references('sancT_id')->on('r_sanction_titles')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('off_id', 't_sanctions_ibfk_3')->references('off_id')->on('r_offices')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('t_sanctions', function(Blueprint $table)
		{
			$table->dropForeign('t_sanctions_ibfk_1');
			$table->dropForeign('t_sanctions_ibfk_2');
			$table->dropForeign('t_sanctions_ibfk_3');
		});
	}

}

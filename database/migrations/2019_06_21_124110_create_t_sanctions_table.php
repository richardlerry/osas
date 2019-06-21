<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTSanctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_sanctions', function(Blueprint $table)
		{
			$table->increments('sanc_id');
			$table->integer('studP_id')->unsigned()->index('studP_id');
			$table->integer('sancT_id')->unsigned()->index('sancT_id');
			$table->integer('off_id')->unsigned()->index('off_id');
			$table->string('totalHours', 10);
			$table->string('caseDesc', 100)->nullable();
			$table->date('completionDate')->nullable();
			$table->date('dateSanctioned')->nullable();
			$table->string('remarks', 100)->nullable();
			$table->boolean('isFinished')->default(0);
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
		Schema::drop('t_sanctions');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRFinancialTitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_financial_titles', function(Blueprint $table)
		{
			$table->increments('finT_id');
			$table->string('title', 50);
			$table->string('desc', 100);
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
		Schema::drop('r_financial_titles');
	}

}

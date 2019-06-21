<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRSanctionTitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_sanction_titles', function(Blueprint $table)
		{
			$table->increments('sancT_id');
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
		Schema::drop('r_sanction_titles');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateROrgFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_org_files', function(Blueprint $table)
		{
			$table->increments('orgF');
			$table->integer('org_id')->unsigned()->index('org_id');
			$table->text('title', 65535);
			$table->string('file', 50)->nullable();
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
		Schema::drop('r_org_files');
	}

}

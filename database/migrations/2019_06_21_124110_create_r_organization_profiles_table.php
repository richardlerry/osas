<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateROrganizationProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_organization_profiles', function(Blueprint $table)
		{
			$table->increments('org_id');
			$table->string('name', 100);
			$table->string('abr', 50);
			$table->string('logo', 50)->nullable();
			$table->string('desc', 100);
			$table->string('orgType', 50);
			$table->date('dateEstablished');
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
		Schema::drop('r_organization_profiles');
	}

}

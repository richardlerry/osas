<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_vouchers', function(Blueprint $table)
		{
			$table->increments('vouch_id');
			$table->integer('org_id')->unsigned()->index('org_id');
			$table->string('or_no', 50);
			$table->string('title', 100);
			$table->string('desc', 100)->nullable();
			$table->text('remarks', 65535)->nullable();
			$table->text('note', 65535)->nullable();
			$table->string('sendBy', 50);
			$table->string('receivedBy', 50);
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
		Schema::drop('r_vouchers');
	}

}

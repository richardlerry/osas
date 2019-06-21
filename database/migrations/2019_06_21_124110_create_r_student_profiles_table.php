<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRStudentProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_student_profiles', function(Blueprint $table)
		{
			$table->increments('studP_id');
			$table->string('stud_no', 20)->unique('stud_no');
			$table->integer('course_id')->unsigned()->index('course_id');
			$table->string('section', 10);
			$table->string('fname', 50);
			$table->string('mname', 50);
			$table->string('lname', 50);
			$table->string('email', 50);
			$table->string('civilStatus', 50);
			$table->string('mobileNo', 50);
			$table->string('telephoneNo', 50);
			$table->string('gender', 20);
			$table->date('birthdate');
			$table->string('homeno', 50);
			$table->string('street', 100);
			$table->string('province', 100);
			$table->string('city', 100);
			$table->string('brgy', 100);
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
		Schema::drop('r_student_profiles');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRStudentProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('r_student_profiles', function(Blueprint $table)
		{
			$table->foreign('course_id', 'r_student_profiles_ibfk_1')->references('course_id')->on('r_courses')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('r_student_profiles', function(Blueprint $table)
		{
			$table->dropForeign('r_student_profiles_ibfk_1');
		});
	}

}

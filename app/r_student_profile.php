<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $course_id
 * @property int $studP_id
 * @property string $stud_no
 * @property string $section
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $email
 * @property string $civilStatus
 * @property string $mobileNo
 * @property string $telephoneNo
 * @property string $gender
 * @property string $birthdate
 * @property string $homeno
 * @property string $street
 * @property string $province
 * @property string $city
 * @property string $brgy
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property RCourse $rCourse
 * @property TFinancialAssistance[] $tFinancialAssistances
 * @property TSanction[] $tSanctions
 */
class r_student_profile extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'studP_id';

    /**
     * @var array
     */
    protected $fillable = ['course_id', 'stud_no', 'section', 'fname', 'mname', 'lname', 'email', 'civilStatus', 'mobileNo', 'telephoneNo', 'gender', 'birthdate', 'homeno', 'street', 'province', 'city', 'brgy', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rCourse()
    {
        return $this->belongsTo(r_course::class, 'course_id', 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tFinancialAssistances()
    {
        return $this->hasMany(t_financial_assistance::class, 'studP_id', 'studP_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tSanctions()
    {
        return $this->hasMany(t_sanction::class, 'studP_id', 'studP_id');
    }
}

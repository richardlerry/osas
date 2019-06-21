<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $course_id
 * @property string $title
 * @property string $desc
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property RStudentProfile[] $rStudentProfiles
 */
class r_course extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'course_id';

    /**
     * @var array
     */
    protected $fillable = ['title', 'desc', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rStudentProfiles()
    {
        return $this->hasMany(r_student_profile::class, 'course_id', 'course_id');
    }
}

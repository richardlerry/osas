<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $sanc_id
 * @property int $off_id
 * @property int $studP_id
 * @property int $sancT_id
 * @property string $totalHours
 * @property string $caseDesc
 * @property string $completionDate
 * @property string $dateSanctioned
 * @property string $remarks
 * @property boolean $isFinished
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property RStudentProfile $rStudentProfile
 * @property RSanctionTitle $rSanctionTitle
 * @property ROffice $rOffice
 */
class t_sanction extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'sanc_id';

    /**
     * @var array
     */
    protected $fillable = ['off_id', 'studP_id', 'sancT_id', 'totalHours', 'caseDesc', 'completionDate', 'dateSanctioned', 'remarks', 'isFinished', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rStudentProfile()
    {
        return $this->belongsTo(r_student_profile::class, 'studP_id', 'studP_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rSanctionTitle()
    {
        return $this->belongsTo(r_sanction_title::class, 'sancT_id', 'sancT_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rOffice()
    {
        return $this->belongsTo(r_office::class, 'off_id', 'off_id');
    }
}

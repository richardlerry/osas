<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $finA_id
 * @property int $finT_id
 * @property int $studP_id
 * @property string $finStatus
 * @property string $remarks
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property RStudentProfile $rStudentProfile
 * @property RFinancialTitle $rFinancialTitle
 */
class t_financial_assistance extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'finA_id';

    /**
     * @var array
     */
    protected $fillable = ['finT_id', 'studP_id', 'finStatus', 'remarks', 'stat', 'created_at', 'updated_at'];

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
    public function rFinancialTitle()
    {
        return $this->belongsTo(t_financial_assistance::class, 'finT_id', 'finT_id');
    }
}

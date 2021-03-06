<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $finT_id
 * @property string $title
 * @property string $desc
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property TFinancialAssistance[] $tFinancialAssistances
 */
class r_financial_title extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'finT_id';

    /**
     * @var array
     */
    protected $fillable = ['title', 'desc', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tFinancialAssistances()
    {
        return $this->hasMany(t_financial_assistance::class, 'finT_id', 'finT_id');
    }
}

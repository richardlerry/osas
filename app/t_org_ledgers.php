<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $org_id
 * @property int $orgL_id
 * @property float $amount
 * @property int $ref_id
 * @property string $type
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property ROrganizationProfile $rOrganizationProfile
 */
class t_org_ledgers extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'orgL_id';

    /**
     * @var array
     */
    protected $fillable = ['org_id', 'amount', 'ref_id', 'type', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rOrganizationProfile()
    {
        return $this->belongsTo(r_organization_profile::class, 'org_id', 'org_id');
    }
}

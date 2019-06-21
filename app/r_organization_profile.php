<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $org_id
 * @property string $name
 * @property string $abr
 * @property string $logo
 * @property string $desc
 * @property string $orgType
 * @property string $dateEstablished
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property ROrgFile[] $rOrgFiles
 * @property RRemittance[] $rRemittances
 * @property RVoucher[] $rVouchers
 * @property TEventProfile[] $tEventProfiles
 * @property TOrgLedger[] $tOrgLedgers
 */
class r_organization_profile extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'org_id';

    /**
     * @var array
     */
    protected $fillable = ['name', 'abr', 'logo', 'desc', 'orgType', 'dateEstablished', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rOrgFiles()
    {
        return $this->hasMany(r_org_file::class, 'org_id', 'org_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rRemittances()
    {
        return $this->hasMany(r_remittance::class, 'org_id', 'org_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rVouchers()
    {
        return $this->hasMany(r_voucher::class, 'org_id', 'org_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tEventProfiles()
    {
        return $this->hasMany(t_event_profile::class, 'org_id', 'org_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tOrgLedgers()
    {
        return $this->hasMany(t_org_ledgers::class, 'org_id', 'org_id');
    }
}

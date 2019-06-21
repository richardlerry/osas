<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $remit_id
 * @property int $org_id
 * @property string $or_no
 * @property string $desc
 * @property string $note
 * @property string $sendBy
 * @property string $receivedBy
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property ROrganizationProfile $rOrganizationProfile
 */
class r_remittance extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'remit_id';

    /**
     * @var array
     */
    protected $fillable = ['org_id', 'or_no', 'desc', 'note', 'sendBy', 'receivedBy', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rOrganizationProfile()
    {
        return $this->belongsTo(r_organization_profile::class, 'org_id', 'org_id');
    }
}

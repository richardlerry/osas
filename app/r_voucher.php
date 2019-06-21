<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $vouch_id
 * @property int $org_id
 * @property string $or_no
 * @property string $title
 * @property string $desc
 * @property string $remarks
 * @property string $note
 * @property string $sendBy
 * @property string $receivedBy
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property ROrganizationProfile $rOrganizationProfile
 * @property TVoucherItem[] $tVoucherItems
 */
class r_voucher extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'vouch_id';

    /**
     * @var array
     */
    protected $fillable = ['org_id', 'or_no', 'title', 'desc', 'remarks', 'note', 'sendBy', 'receivedBy', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rOrganizationProfile()
    {
        return $this->belongsTo(r_organization_profile::class, 'org_id', 'org_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tVoucherItems()
    {
        return $this->hasMany(t_voucher_item::class, 'vouch_id', 'vouch_id');
    }
}

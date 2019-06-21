<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $org_id
 * @property int $eventP_id
 * @property string $title
 * @property string $desc
 * @property string $file
 * @property string $proposedDate
 * @property string $revBy
 * @property string $eventStatus
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property ROrganizationProfile $rOrganizationProfile
 */
class t_event_profile extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'eventP_id';

    /**
     * @var array
     */
    protected $fillable = ['org_id', 'title', 'desc', 'file', 'proposedDate', 'revBy', 'eventStatus', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rOrganizationProfile()
    {
        return $this->belongsTo(r_organization_profile::class, 'org_id', 'org_id');
    }
}

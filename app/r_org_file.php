<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $org_id
 * @property int $orgF
 * @property string $title
 * @property string $file
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property ROrganizationProfile $rOrganizationProfile
 */
class r_org_file extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'orgF';

    /**
     * @var array
     */
    protected $fillable = ['org_id', 'title', 'file', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rOrganizationProfile()
    {
        return $this->belongsTo(r_organization_profile::class, 'org_id', 'org_id');
    }
}

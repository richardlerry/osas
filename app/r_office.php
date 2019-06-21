<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $off_id
 * @property string $title
 * @property string $desc
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property TSanction[] $tSanctions
 */
class r_office extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'off_id';

    /**
     * @var array
     */
    protected $fillable = ['title', 'desc', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tSanctions()
    {
        return $this->hasMany(t_sanction::class, 'off_id', 'off_id');
    }
}

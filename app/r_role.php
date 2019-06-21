<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $role_id
 * @property string $title
 * @property string $desc
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $users
 */
class r_role extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'role_id';

    /**
     * @var array
     */
    protected $fillable = ['title', 'desc', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(user::class, 'role_id', 'role_id');
    }
}

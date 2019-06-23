<?php

namespace App;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property boolean $stat
 * @property string $created_at
 * @property string $updated_at
 * @property RRole $rRole
 */
class user extends Authenticatable
{
    /**
     * @var array
     */
    protected $fillable = ['role_id', 'name', 'email', 'password', 'remember_token', 'stat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rRole()
    {
        return $this->belongsTo(r_role::class, 'role_id', 'role_id');
    }
}

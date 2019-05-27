<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use App\Models\Permission;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'empresa_id', 'funcionario_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Condominio()
    {
        return $this->belongsTo(\Modules\Condominios\Entities\Condominio::class, 'condominio_id');
    }

    public function funcionario()
    {
        return $this->belongsTo(\Modules\Funcionarios\Entities\Funcionario::class, 'funcionario_id');
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }
        if (is_array($roles)) {
            foreach ($roles as $r) {
                if ($this->hasAnyRoles($r)) {
                    return true;
                }
            }
        }
        // if we're dealing in collections
        return !! $roles->intersect($this->roles)->count();
        return false;
    }
    
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                abort(403, 'Não está autorizado a ver essa página.');
      }
      return $this->hasRole($roles) || 
            abort(403, 'Não está autorizado a ver essa página.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}

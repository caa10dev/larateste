<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    protected $fillable = [
        'name',
        'label'
    ];

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }

    public function users()
	{
	  return $this->belongsToMany(User::class);
	}

    /**
     * Determine if the user may perform the given permission.
     *
     * @param string|Permission $permission
     *
     * @return bool
     *
     * @throws \Spatie\Permission\Exceptions\GuardDoesNotMatch
     */
    public function hasPermissionTo($permission): bool
    {
        if (is_string($permission)) {
            $permission = app(Permission::class)->where('name', $permission)->first();
        }

        if (is_int($permission)) {
            $permission = app(Permission::class)->where('id', $permission)->first();
        }

        return $this->permissions->contains('id', $permission->id);
    }

    public function givePermissionTo($permissions)
    {
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) {
                return $this->getStoredPermission($permission);
            })
            ->all();

        $this->permissions()->saveMany($permissions);

        return $this;
    }

    public function syncPermissions($permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionTo($permissions);
    }

    protected function getStoredPermission($permissions)
    {
        if (is_numeric($permissions)) {
            return app(Permission::class)->where('id', $permissions)->first();
        }

        if (is_string($permissions)) {
            return app(Permission::class)->where('name', $permissions)->first();
        }

        if (is_array($permissions)) {
            return app(Permission::class)
                ->whereIn('name', $permissions)
                ->get();
        }

        return $permissions;
    }
}

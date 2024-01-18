<?php

namespace App\Traits;

use App\Models\Permission;

trait HasPermissionsTrait
{ 
    public function hasPermission(...$permissions)
    {   
        foreach($permissions as $permission) {
            if ($this->permissions->contains('slug', $permission)) {
                return true;
            }
        }
        return false;
    }
  
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
  
}

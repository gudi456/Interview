<?php

namespace App\Traits;

use App\Role;

trait Roleable
{
    /**
     * Define the many-to-many relationship with roles.
     *
     * @param string|null $pivotTable
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles($pivotTable = null)
    {
        if ($pivotTable) {
            return $this->belongsToMany(Role::class, $pivotTable);
        } else {
            return $this->belongsToMany(Role::class);
        }
    }

    /**
     * Assign one or more roles to the model.
     *
     * @param mixed $roles
     */
    

    /**
     * Revoke one or more roles from the model.
     *
     * @param mixed $roles
     */
    

    /**
     * Check if the model has a specific role.
     *
     * @param string $roleName
     * @return bool
     */
    
}

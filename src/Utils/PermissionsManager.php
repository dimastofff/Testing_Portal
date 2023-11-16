<?php

namespace App\Utils;

use App\Models\Role;

class PermissionsManager
{
    /**
     * Method which return status of access resolution for provided role for current user.
     *
     * @param Role  $accessLevelRole Minimul role, which user must have to get access.
     * @return bool Return 'true' if user has access and return 'false' if access denied for current user.
     */
    public static function isUserHasAccess(Role $accessLevelRole): bool
    {
        $currentRole = isset($_SESSION['user']) ? Role::fromName($_SESSION['user']['role']) : Role::Unauthorized;

        if ($currentRole->value < $accessLevelRole->value) {
            return false;
        } else if ($currentRole->value > $accessLevelRole->value && $accessLevelRole === Role::Unauthorized) {
            return false;
        }
        return true;
    }
}

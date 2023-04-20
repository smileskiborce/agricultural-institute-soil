<?php

namespace App\Policies;

use App\Enums\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(Permission::VIEW_CLIENT->value);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Permission::CREATE_CLIENT->value);
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo(Permission::EDIT_CLIENT->value);
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(Permission::DELETE_CLIENT->value);
    }
}

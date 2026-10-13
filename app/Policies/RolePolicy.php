<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;

class RolePolicy
{
    /**
     * Tentukan siapa saja yang boleh melihat menu Roles
     */
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'admin']);
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'admin']);
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'admin']);
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'admin']);
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'admin']);
    }
}
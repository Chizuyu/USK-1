<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Schema;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchemaPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Schema');
    }

    public function view(AuthUser $authUser, Schema $schema): bool
    {
        return $authUser->can('ViewAny:Schema');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Schema');
    }

    public function update(AuthUser $authUser, Schema $schema): bool
    {
        return $authUser->can('Update:Schema');
    }

    public function delete(AuthUser $authUser, Schema $schema): bool
    {
        return $authUser->can('Delete:Schema');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Schema');
    }

    public function restore(AuthUser $authUser, Schema $schema): bool
    {
        return $authUser->can('Restore:Schema');
    }

    public function forceDelete(AuthUser $authUser, Schema $schema): bool
    {
        return $authUser->can('ForceDelete:Schema');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Schema');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Schema');
    }

    public function replicate(AuthUser $authUser, Schema $schema): bool
    {
        return $authUser->can('Replicate:Schema');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Schema');
    }
}

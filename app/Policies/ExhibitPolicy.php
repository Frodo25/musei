<?php

namespace App\Policies;

use App\Models\Exhibit;
use App\Models\User;

class ExhibitPolicy
{
    public function before(User $user): ?bool
    {
        return $user->role === 'admin' ? true : null;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user, Exhibit $exhibit): bool
    {
        return $user->role === 'editor' && $exhibit->user_id === $user->id;
    }

    public function delete(User $user, Exhibit $exhibit): bool
    {
        return $this->update($user, $exhibit);
    }
}
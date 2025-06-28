<?php

namespace App\Policies;

use App\Models\Bus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Bus $bus)
    {
        return $user->id === $bus->operator_id;
    }

    public function delete(User $user, Bus $bus)
    {
        return $user->id === $bus->operator_id;
    }
}
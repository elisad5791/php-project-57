<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class StatusPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Status $status)
    {
        return Auth::check();
    }

    public function store(User $user, Status $status)
    {
        return Auth::check();
    }

    public function edit(User $user, Status $status)
    {
        return Auth::check();
    }

    public function update(User $user, Status $status)
    {
        return Auth::check();
    }

    public function destroy(User $user, Status $status)
    {
        return Auth::check();
    }
}

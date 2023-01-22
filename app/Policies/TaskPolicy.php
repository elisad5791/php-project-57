<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Task $task)
    {
        return Auth::check();
    }

    public function store(User $user, Task $task)
    {
        return Auth::check();
    }

    public function edit(User $user, Task $task)
    {
        return Auth::check();
    }

    public function update(User $user, Task $task)
    {
        return Auth::check();
    }

    public function destroy(User $user, Task $task)
    {
        return $task->created_by->is($user);
    }

}

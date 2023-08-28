<?php

namespace App\Policies;

use App\Models\TodoItem;
use App\Models\User;

class TodoItemPolicy
{
    /**
     * IMPORTANT:
     * Altough update() and delete() excecute the same line of code, they are separated in different methods
     * due to Open-Close principle.
     */

    /**
     * Determine if the given todo item can be updated by the user.
     */
    public function update(User $user, TodoItem $todoItem): bool
    {
        return $user->id === $todoItem->user_id;
    }

    /**
     * Determine if the given todo item can be deleted by the user.
     */
    public function delete(User $user, TodoItem $todoItem): bool
    {
        return $user->id === $todoItem->user_id;
    }
}
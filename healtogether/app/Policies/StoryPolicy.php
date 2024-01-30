<?php

namespace App\Policies;
use App\Models\Story;
use App\Models\User;

class StoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function delete(User $user, Story $story)
{
    return $user->id === $story->user_id;
}

}

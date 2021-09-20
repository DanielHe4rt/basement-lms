<?php

namespace LMS\User\Observers;

use LMS\User\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $user->address()->create();
    }
}

<?php

namespace Sebastienheyd\Boilerplate\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Sebastienheyd\Boilerplate\Models\User;

class UserSaved
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        RefreshDatatable::broadcast('users')->toOthers();
    }
}

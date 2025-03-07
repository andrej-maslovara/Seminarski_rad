<?php

namespace App\Listeners;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Events\RoleDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleRoleDeleting
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    public function handle(RoleDeleted $event)
    {
        $deletedRole = $event->role;

        User::where('role_id','role', $deletedRole->id)
            ->update([
                'role' => 'No role',
                'role_id' => 4,
            ]);
    }
}

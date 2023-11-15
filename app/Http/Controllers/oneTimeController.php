<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class oneTimeController extends Controller
{

    // These are functions only used once after migration
    // to implement data into the DB needed for everything to work properly

    public function createRoles()
{
    $adminRole = Role::create(['name' => 'admin']);
    $editorRole = Role::create(['name' => 'editor']);
    $bloggerRole = Role::create(['name' => 'blogger']);

    $adminPermission = Permission::create(['name' => 'admin']);
    $editorPermission = Permission::create(['name' => 'editor']);
    $userPermission = Permission::create(['name' => 'user']);

    $adminRole->givePermissionTo($adminPermission);
    $editorRole->givePermissionTo($editorPermission);
    $bloggerRole->givePermissionTo($userPermission);
    
    $adminRole->id;
    $editorRole->id;
    $bloggerRole->id;

    return 'Roles created successfully.';
}



}

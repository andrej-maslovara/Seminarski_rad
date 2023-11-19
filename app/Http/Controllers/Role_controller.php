<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Events\RoleDeleted;
use Illuminate\Database\Schema\Blueprint;

class Role_controller extends Controller
{
    // Change or assign existing role to a user
    public function assignRole(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required',
    ]);

    $user = User::findOrFail($request->user_id);

    $specialRoles = [
        'admin' => 1,
        'editor' => 2,
        'blogger' => 3,
        'No role' => 4,
    ];

      if (array_key_exists($request->role, $specialRoles)) {
        
        $user->update([
            'role' => $request->role,
            'role_id' => $specialRoles[$request->role],
        ]);
    } else {
        
        $role = Role::firstOrCreate(['name' => $request->role]);

    $user->update([
        'role' => $request->role,
        'role_id' => $role->id,]);}

    return redirect()->back()->with('success', 'Role assigned successfully.');
}

//Creating new roles
public function createRole(Request $request)
{
    $request->validate([
        'new_role' => 'required|unique:roles,name',
    ]);

    Role::create([
        'name' => $request->input('new_role'),
    ]);

    return redirect()->back()->with('success', 'New role created successfully.');
}

//Role listing
public function getAllRoles()
    {
        $users = User::all();
        
        $roles = Role::all();
    
        return view('assign-role', compact('users', 'roles'));
    }

    public function showRolesPage()
    {
        $roles = Role::all();
        return view('roles', compact('roles'));
    }

    //Role removing and changing role to users who had the newly created roles
    public function deleteRole(Role $role)
{
  
    if (in_array($role->name, ['admin', 'editor', 'blogger', 'No role'])) {

        $usersToUpdate = User::where('role', $role->name)->get();

        foreach ($usersToUpdate as $user) {
            $user->update(['role' => 'No role', 'role_id' => 4]);
        }
    }


    $role->delete();

    $this->checkAndUpdateUserRoles();

    return redirect()->route('roles')->with('success', 'Role deleted successfully.');
}

private function checkAndUpdateUserRoles()
{
    $users = User::all();

    foreach ($users as $user) {
        $userRole = $user->role;


        $roleExists = Role::where('name', $userRole)->exists();

        if (!$roleExists) {

            $user->update(['role' => 'No role', 'role_id' => 4]);
        }
    }
}

}

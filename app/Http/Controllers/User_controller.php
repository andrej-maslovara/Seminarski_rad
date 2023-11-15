<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class User_controller extends Controller
{   
        // registration system
    public function register(Request $request) {

             $input_data = $request->validate([
            'name' => ['required', 'min:3', 'max:25', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:30']       
          ]);
        
        $user = User::create([
            'name' => $input_data['name'],
            'email' => $input_data['email'],
            'password' => bcrypt($input_data['password']),
            'role' => 'blogger',
            'role_id' => '3'
        ]);

        auth()->login($user);

        return redirect('/');
    }
    // login system
    public function login(Request $request){
        $input_data = $request->validate([
            'login_name' => 'required',
            'login_password' => 'required'
        ]);

        if (auth()->attempt(['name' => $input_data['login_name'],
                        'password' => $input_data['login_password']])) 
        {
            $request->session()->regenerate();
        }
        return redirect ('/');}
        
    //logout system
    public function logout(){
        auth()->logout();
        return redirect ('/');
    }
     

public function assignRoleToUser(Request $request)
{
    $users = User::all();
    return view('/assign-role', ['users' => $users]);}


public function assignRole(Request $request)
{
    // Validate the request
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|in:admin,editor,blogger',
    ]);

    $roleMappings = [
        'admin' => 1,
        'editor' => 2,
        'blogger' => 3,
    ];

    // Find the user
    $user = User::findOrFail($request->user_id);

    // Update the user's role
    $user->update([
        'role' => $request->role,
        'role_id' => $roleMappings[$request->role],]);

    return redirect()->back()->with('success', 'Role assigned successfully.');
}
  
public function deleteUser(User $user)
{
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully.');
}

}

        // Potential user checkup:

// [if (auth()->user()->can('create')) {
//     // User has the 'create' permission, allow them to perform the action
// } else {
//     // User does not have the 'create' permission, deny the action
// }]



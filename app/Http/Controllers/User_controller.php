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
            'role' => 'No role',
            'role_id' => NULL
        ]);

        // Check if the email address contains the admin domain
        if (Str::contains($input_data['email'], '@php207.hr')) {
            // Set 'role' and 'role_id' for users with the admin domain
            $user->update(['role' => 'admin', 'role_id' => '1']);
        }

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
 
public function deleteUser(User $user)
{
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully.');
}

public function showUserList(){
    $users = User::all();
    return view('user-list', ['users' => $users]);
    }

}

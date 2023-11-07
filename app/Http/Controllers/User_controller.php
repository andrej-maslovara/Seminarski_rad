<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class User_controller extends Controller
{   // registration system
    public function register(Request $request) {
        $input_reg = $request->validate([
            'name' => ['required', 'min:3', 'max:25', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:30']
        ]);
        
        $input_reg['password'] = bcrypt($input_reg['password']);
                        // or 'bcrypt' instead of 'Hash::make'
        $new_user = User::create($input_reg);
        auth()->login($new_user);
        return redirect('/');
    }
    // login system
    public function login(Request $request){
        $input_reg = $request->validate([
            'login_name' => 'required',
            'login_password' => 'required'
        ]);

        if (auth()->attempt(['name' => $input_reg['login_name'],
                        'password' => $input_reg['login_password']])) 
        {
            $request->session()->regenerate();
        }
        return redirect ('/');} // change the redirect path

    //logout system
    public function logout(){
        auth()->logout();
        return redirect ('/');
    }
}

<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post_controller;
use App\Http\Controllers\Role_controller;
use App\Http\Controllers\User_controller;
use App\Http\Controllers\oneTimeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});

Route::get('/my-posts', function () {
    $posts = [];
    if(auth()->check())
    {$posts = auth()->user()->usersPosts()->latest()->get();}
    return view('my-posts', ['posts' => $posts]);
});

// Entry system
Route::post('/register', [User_controller::class, 'register']);
Route::post('/logout', [User_controller::class, 'logout']);
Route::post('/login', [User_controller::class, 'login']);

//Post system
Route::post('/create-post', [Post_controller::class, 'createPost']);
Route::get('/edit-post/{post}', [Post_controller::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [Post_controller::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [Post_controller::class, 'deletePost']);

// Roles created successfully. ->
Route::get('/create-roles', [oneTimeController::class, 'createRoles']);

Route::get('/assign-role', [User_controller::class, 'assignRoleToUser']);

Route::post('/assign-role', [User_Controller::class, 'assignRole'])->name('assign-role');

Route::delete('/delete-user/{user}', [User_controller::class, 'deleteUser'])->name('delete-user');

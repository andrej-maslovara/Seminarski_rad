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

// Href redirectings
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/create-post', function () {
    return view('create-post');
})->name('create-post');

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

Route::get('/all-posts', function () {
    $posts = [];
    $posts = Post::all();
    return view('all-posts', ['posts' => $posts]);
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


//Admin user editing
Route::get('/assign-role', [Role_controller::class, 'getAllRoles'])->name('assign-role');

Route::post('/assign-role', [Role_Controller::class, 'assignRole'])->name('assign-role');

Route::get('/roles', [Role_controller::class, 'showRolesPage'])->name('roles');

Route::delete('/delete-role/{role}', [Role_controller::class, 'deleteRole'])->name('delete-role');

Route::delete('/delete-user/{user}', [User_controller::class, 'deleteUser'])->name('delete-user');

Route::post('/create-role', [Role_controller::class, 'createRole'])->name('create-role');


//Non-admin post and user views and editing
Route::get('/user-list', [User_controller::class, 'showUserList'])->name('user-list');

Route::get('/users-posts/{userId}', [Post_controller::class, 'getUsersPosts'])->name('users-posts');

Route::get('/edit-post/{id}', [Post_controller::class, 'showEditScreen'])->name('edit-post');

Route::delete('/delete-post/{id}', [Post_controller::class, 'deletePost'])->name('delete-post');

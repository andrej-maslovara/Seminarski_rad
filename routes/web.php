<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post_controller;
use App\Http\Controllers\User_controller;
use App\Http\Controllers\Register_screen;

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
    $posts = [];
    if(auth()->check())
    {$posts = auth()->user()->usersPosts()->latest()->get();}
    // $posts = Post::where('user_id', auth()->id())->get();
    return view('home', ['posts' => $posts]);
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
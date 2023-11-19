<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post_controller extends Controller {

    //Creating a post/blog
    public function createPost(Request $request){
        $input_data = $request->validate([
            'title' => 'required', 
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $input_data['image'] = $imageName;
        }

        $input_data['title'] = strip_tags($input_data['title']);
        $input_data['body'] = strip_tags($input_data['body']);
        $input_data['user_id'] = auth()->id();
        Post::create($input_data);
        
        return redirect('/create-post');
    }

    //Post listing
    public function showPosts() {
    $posts = Post::all();

    return view('my-posts', ['posts' => $posts]);
    }   

    public function showAllPosts() {
        $posts = Post::all();
    
        return view('all-posts', ['posts' => $posts]);
        }   

        //Editing posts
    public function showEditScreen(Post $post){
        if(auth()->user()->id === $post['user_id'] || auth()->user()->role_id === 1  || auth()->user()->role_id === 2)
        {return view('edit-post', ['post' => $post]);}
     else {return redirect('/');}}

     public function actuallyUpdatePost(Post $post, Request $request){
         if (auth()->user()->id === $post['user_id'] || auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
         {$input_data = $request->validate([
                 'title' => 'required',
                 'body' => 'required'
             ]);
     
             $input_data['title'] = strip_tags($input_data['title']);
             $input_data['body'] = strip_tags($input_data['body']);
     
             if ($request->has('remove_image') && $post->image) {
                 // Delete the existing image
                 Storage::delete("public/storage/images/{$post->image}");
                 $input_data['image'] = null; // Set image column to null
             }
     
             // Check if a new image is provided
             if ($request->hasFile('new_image')) {
                 // Upload the new image
                 $imagePath = $request->file('new_image')->store('public/images');
                 $input_data['image'] = basename($imagePath);
             }
     
             $post->update($input_data);
             return back()->with('success', 'Post changed successfully.');
         } else {
             return back();
         }
     }
     
    public function deletePost(Post $post){
        if (auth()->user()->id === $post['user_id'] || auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
        {$post->delete();}
        return back()->with('success', 'Post deleted successfully.');
    }

    //Listing the specified users posts
    public function getUsersPosts($userId)
    {
        $user = User::findOrFail($userId);

        $posts = Post::where('user_id', $userId)->get();

        return view('users-posts', compact('user', 'posts'));
    }
}

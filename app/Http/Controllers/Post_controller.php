<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class Post_controller extends Controller
{
    public function createPost(Request $request){
        $input_reg = $request->validate([
            'title' => 'required', 
            'body' => 'required'
        ]);

        $input_reg['title'] = strip_tags($input_reg['title']);
        $input_reg['body'] = strip_tags($input_reg['body']);
        $input_reg['user_id'] = auth()->id();
        Post::create($input_reg);
        return redirect('/');
    }

    public function showEditScreen(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }


        return view('edit-post', ['post' => $post]);
    }

    public function actuallyUpdatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $input_reg = $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $input_reg['title'] = strip_tags($input_reg['title']);
        $input_reg['body'] = strip_tags($input_reg['body']);

        $post->update($input_reg);
        return redirect('/');
    }

    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }

        return redirect('/');

    }
}

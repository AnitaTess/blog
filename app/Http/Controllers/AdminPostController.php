<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;

class AdminPostController extends Controller
{
    public function allposts()
    {
        if (auth()->user()->is_admin >= 1){
        return view('admin.posts.allposts', [
            'posts' => Post::all()
        ]);}
        else{
            abort(403);
        }
    }

    public function edit(Post $post)
    {
        if (auth()->user()->is_admin >= 1){
        return view('admin.posts.edit', [
            'post' => $post
        ]);}
        else{
            abort(403);
        }
    }

    public function update(Post $post)
    {
        $org=array("hell", "idiot", "hate", "stupid");
        $rep=array("heck", "dummy", "dislike", "silly");

        if (auth()->user()->is_admin >= 1){
        $attributes = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'image'
            ]);
   
if (isset($attributes['thumbnail'])){
    $post = Post::findOrFail($post->id);
    Storage::disk('public')->delete($post->thumbnail);
    $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');

    
}
            $attributes = str_ireplace($org, $rep, $attributes);
            $post->update($attributes);
            return back()-> with('success', "Post Updated");
    }
            else{
                abort(403);
            }
    }

    public function destroy(Post $post){
        if (auth()->user()->is_admin >= 1){
            $post = Post::findOrFail($post->id);
            Storage::disk('public')->delete($post->thumbnail);
        $post->delete();
        return back()-> with('success', "Post Deleted");}

        else{
            abort(403);
        }
    }
}

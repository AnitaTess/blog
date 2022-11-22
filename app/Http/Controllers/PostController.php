<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function create()
    {
if(auth()->user()->is_admin >= 1){
    
    return view('admin.posts.create');
}
else{
    abort(403);
}
}
public function store()
    {
        $org=array("hell", "idiot", "hate", "stupid");
        $rep=array("heck", "dummy", "dislike", "silly");
 
        if (auth()->user()->is_admin >= 1){
            $attributes = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'required|image'
            ]);

            $attributes = str_ireplace($org, $rep, $attributes);
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');
            
            Post::create($attributes);
            return redirect('/');
            }
            else{
                abort(403);
            }
    }
}

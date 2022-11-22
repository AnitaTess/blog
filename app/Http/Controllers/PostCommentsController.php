<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {

        $org=array("hell", "idiot", "hate", "stupid");
        $rep=array("heck", "dummy", "dislike", "silly");

$art = request()->validate([
'body' => 'required'
]);
$art = str_ireplace($org, $rep, $art);
$post->comments()->create([
    'user_id' => request()->user()->id,
    'body' => $art['body']
]);

return back();
    }
}
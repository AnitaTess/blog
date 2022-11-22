<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;

class AdminUserController extends Controller
{
    public function allusers()
    {
        if (auth()->user()->is_admin >= 1){
        return view('admin.posts.allusers', [
            'users' => User::all()->where('is_admin', '<', 2)
        ]);}
        else{
            abort(403);
        }
    }

    public function destroy(User $user){
        if (auth()->user()->is_admin === 2){
        
        $user->delete();
        return back()-> with('success', "User Deleted");}

        else{
            abort(403);
        }
    }

    public function useredit(User $user)
    {
        if (auth()->user()->is_admin === 2){
            if($user->username !== 'admin'){
        return view('admin.posts.edituser', [
            'user' => $user
        ]);}
        else{
            abort(403);
        }
    }}

    public function update(User $user)
    {
        if (auth()->user()->is_admin === 2){
        $attributes = request()->validate([
            'is_admin' => 'required|integer',
            'username' => 'required'
            ]);
            $user->is_admin = (int)$attributes['is_admin'];
            $user->update($attributes);
            return back()-> with('success', "User's admin status updated");
    }
            else{
                abort(403);
            }
    }
}

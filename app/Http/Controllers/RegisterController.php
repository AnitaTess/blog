<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\HelloEmail;

class RegisterController extends Controller
{
    public function create()
    {
return view('register.create');
    }
    public function store()
    {
$attributes = request()->validate([
    'username' => 'required|unique:users,username',
    'email' => 'required|email|unique:users,email',
    'password' => ['required', 'min:8'],
    'passwordrepeat' => ['same:password']
]);

$attributes['password'] = bcrypt($attributes['password']);

$user = User::create($attributes);
$user->notify(new HelloEmail($user));

auth()->login($user);

session() -> flash('success', 'You successfully created your new account!');

return redirect('/');
    }
}

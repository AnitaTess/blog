<?php

namespace App\Http\Controllers;


class SessionController extends Controller
{

public function create()
{
    return view('sessions.create');
}

public function store()
{
    $attributes = request()->validate([
        'email' => 'required|exists:users,email',
        'password' => 'required'
    ]);

    if (auth()->attempt($attributes)){
        session()->regenerate();
        return redirect('/') ->with('success', 'You succesfully logged in!');
    }

    return back()
    ->withInput()
    ->withErrors(['password' => 'Wrong password or email.']);
}

    public function destroy()
    {
auth()->logout();

return redirect('/')->with('success', 'You successfully logged out!');
    }
}

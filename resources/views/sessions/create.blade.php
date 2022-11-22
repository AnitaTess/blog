<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- links -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<!-- CSS -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #C8B3E6;
            }
        </style>
    </head>

    <body>
        <section class="px-6 py-8">
            <main class="max-w-lg mx-auto mt-10 bg-pink-100 p-6 border border-pink-300 rounded-xl">
                <h1 class="text-center font-bold text-xl">Login</h1>
<!-- login form -->
<form method="POST" action="/sessions" class="mt-10">
                    @csrf
<div class="mb-6">                    
<label for="username">email</label>
<input class="border border-gray-400 p-2 w-full" type="email" name="email" id="email" value="{{ old('email') }}"  required>
@error('email')
<p class="text-red-500 text-ms mt-1">{{ $message }}</p>
@enderror
</div>

<div class="mb-6">
<label for="password">password</label>
<input class="border border-gray-400 p-2 w-full" type="password" name="password" id="password" required>
@error('password')
<p class="text-red-500 text-ms mt-1">wrong password!</p>
@enderror
</div>
<div class="mb-3">
<a class="underline" href="{{ route('forget.password.get') }}">Reset Password</a>
</div>
<!-- submit form -->
<button class="bg-pink-400 text-white rounded py-2 px-4 hover:bg-pink-600" type="submit">Log In</button>

        </div>
        </form>
        </main>
        </section>
    </body>
</html>
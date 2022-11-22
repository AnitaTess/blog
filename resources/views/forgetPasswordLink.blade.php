<!DOCTYPE html>
<html lang="en">
<head>
<title>Big Tiny Thoughts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<!-- CSS -->
<style>
</style>
</head>
<body>

<!-- Navbar -->
<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
  <div class="container flex flex-wrap justify-between items-center mx-auto">
  <a href="/" class="flex items-center">
      <img src="/logo.png" class="mr-5 h-8 sm:h-16" alt="BTT Logo">
      <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Welcome to Big Tiny Thoughts!</span>
  </a>
  <div class="flex md:order-2">
    <!-- login logout button -->
    
    @auth
    <form method="POST" action="/logout">
        @csrf
      <button type="submit" class="text-white bg-pink-500 hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Logout</button>
      </form>
      @else
      <form method="GET" action="/login">
        @csrf
      <button type="submit" class="text-white bg-pink-500 hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
      </form>
      @endauth
           <!-- navbar for mobile devices -->
  </div>
  <div class="justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-cta">
    <!-- Home button -->
    <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      <li>
        <a href="/" class="block py-2 pr-4 pl-3 text-white bg-pink-700 rounded md:bg-transparent md:text-pink-700 md:p-0 dark:text-white" aria-current="page">Home</a>
      </li>
      <!-- show register option only to guest users -->
@guest
      <li>
        <a href="/register" class="block py-2 pr-4 pl-3 text-pink-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-black-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Register</a>
      </li>
@endguest
<!-- admin dashboard -->
@can('admin')
      <li>
        <a href="/admin/posts/allposts" class="block py-2 pr-4 pl-3 text-pink-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-black-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Admin</a>
      </li>
@endcan
    </ul>
  </div>
  </div>
</nav>

<main class="login-form">
<div class="max-w-lg mx-auto mt-10 bg-pink-100 p-6 border border-pink-300 rounded-xl">
<section class="px-6 py-8">
<div class="cotainer">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header text-center font-bold text-xl mb-4">Reset Password</div>
<div class="card-body text-center">
<form action="{{ route('reset.password.post') }}" method="POST">
@csrf
 <input type="hidden" name="token" value="{{ $token }}">
 <div class="form-group row">
<label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
 <div class="col-md-6">
<input type="text" id="email_address" class="form-control mb-3" name="email" required autofocus>
      @if ($errors->has('email'))
<span class="text-danger">{{ $errors->first('email') }}</span>
       @endif
</div>
 </div>
<div class="form-group row">
 <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
 <div class="col-md-6">
<input type="password" id="password" class="form-control mb-3" name="password" required autofocus>
      @if ($errors->has('password'))
<span class="text-danger">{{ $errors->first('password') }}</span>
     @endif
  </div>
   </div>
<div class="form-group row">
<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
 <div class="col-md-6">
<input type="password" id="password-confirm" class="form-control mb-3" name="password_confirmation" required autofocus>
          @if ($errors->has('password_confirmation'))
        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
         @endif
 </div>
 </div>
     <div class="col-md-6 offset-md-4">
 <button type="submit" class="bg-pink-400 text-white rounded py-2 px-4 hover:bg-pink-600">
       Reset Password
</button>
         </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
</div>
</main>
</body>
</html>
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
      @auth
      <li>
        <a href="/showuser" class="block py-2 pr-4 pl-3 text-white bg-pink-700 rounded md:bg-transparent md:text-pink-700 md:p-0 dark:text-white" aria-current="page">My Account</a>
      </li>
      @endauth
      <!-- show register option only to guest users -->
@guest
      <li>
        <a href="/register" class="block py-2 pr-4 pl-3 text-pink-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-black-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Register</a>
      </li>
@endguest
<!-- admin dashboard -->
@can('admin')
      <li>
        <a href="/admin/posts/allposts" class="block py-2 pr-4 pl-3 text-pink-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-black-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
          Admin</a>
      </li>
@endcan
    </ul>
  </div>
  </div>
</nav>

<div class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
<section class="col-span-10 col-start-2 mt-10">
<form method="GET" action="/">
        @csrf
      <button type="submit" class="text-white bg-pink-500 hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Go Back</button>
      </form>
  <article class="bg-pink-100 p-6 rounded-xl border border-pink-200 m-4 space-x-4">
  <h1 class="text-center font-bold mb-4 text-4xl">{{$post->title}}</h1>
  <div class="font-semibold text-center">
  {{$post->body}}
  </div>
  </article>

  <div class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
<section class="col-span-8 col-start-3 mt-4">

@auth
<form method="POST" action="/posts/{{ $post->id }}/comments" class="p-6 rounded-xl border border-pink-200 mb-8 space-x-4">
@csrf
  <header class="flex items-center">
  <img src="/logo.png" alt="avatar" width="50" height="50" class="rounded-xl"> 
  <h2 class="ml-4">Share Your Thought!</h2>
  </header>
  <div class="mt-6">
<textarea name="body" class="w-full text-sm focus:outline-none" rows="5" placeholder="Don't be shy, write your thought here!" required></textarea>
</div>
  <div class="justify-end flex mt-2">
  <button class="bg-pink-400 text-white rounded py-2 px-4 hover:bg-pink-600" type="submit">Share</button>
</div>
</form>
@endauth


@foreach ($post->comments as $comment)
<section>
  <article class="flex bg-pink-100 p-6 rounded-xl border border-pink-200 m-4 space-x-4">
    <div class="flex-shrink-0">
      <img src="https://i.pravatar.cc/100?u={{ $comment->author->id }}" alt="avatar" class="rounded-xl">
    </div>
    <div>
      <header class="mb-3">
      <h3 class="font-bold">{{ $comment->author->username }}</h3>
      <p class="text-xs">Posted:
<time>{{ $comment->created_at->format('j F Y, g:i a') }}</time></p>
</header>
<p>{{ $comment->body }}</p>
    </div>
    <article>
    </section>
    @endforeach
    
</section>
</div>
</section>
</body>
</html>
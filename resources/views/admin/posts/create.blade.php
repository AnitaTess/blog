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
<body class="bg-pink-100">
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
        <a href="/admin/posts/allposts" class="block py-2 pr-4 pl-3 text-pink-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-black-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Admin</a>
      </li>
@endcan
    </ul>
  </div>
  </div>
</nav>


<!-- create post form -->
<div class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
<section class="col-span-12 col-start-0 mt-4 ">
<form method="POST" action="/admin/posts" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-pink-200 mb-8 space-x-4">
@csrf
    <h2 class="ml-4 text-xl font-bold">Create new topic for thoughts:</h2>
  <div class="mt-6">
  <label for="title">Title</label>
<input class="border border-gray-400 p-2 w-full" type="text" name="title" id="title" required>
</div>
<div class="mt-6">
  <label for="body">What is this topic about?</label>
<input class="border border-gray-400 p-2 w-full" type="text" name="body" id="body" required>
</div>
<div class="mt-6">
  <label for="body">Add a thumbnail:</label>
<input class="border border-gray-400 p-2 w-full" type="file" name="thumbnail" id="thumbnail" required>
</div>
  <div class="justify-end flex mt-2">
  <button class="bg-pink-400 text-white rounded py-2 px-4 hover:bg-pink-600" type="submit">Public</button>
</div>
</form>
</div>
</section>
</body>
</html>
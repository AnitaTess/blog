<!DOCTYPE html>
<html lang="en">
<head>
<title>Big Tiny Thoughts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<!-- CSS -->
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
<main>
<!-- create post form -->
<h1 class="font-bold mb-4 text-4xl text-center mt-4">Manage Posts Here</h1>
<div class="text-center mb-3 mt-5">
<a href="/admin/posts/create" class="text-xl mr-5 font-bold hover:text-pink-800">Add New Post</a>
<a href="/admin/posts/allusers" class="text-xl font-bold hover:text-pink-800">All Users</a>
</div>
<div class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
  <section class="col-span-10 col-start-2 mt-10">
<div class="overflow-x-auto ">
  <div class="align-middle inline-block min-w-full">
    <div class="shadow overflow-hidden border-b border-pink-300 sm:rounded-lg">
<table class="min-w-full divide-y divide-pink-200">
<tbody class="bg-white divide-y divide-pink-200">
  @foreach ($posts as $post)
<tr>
<td class="px-6 py-4 whitespace-nowrap">
<div class="flex items-center">
<div class="text-sm font-medium text-gray-900">
    id: {{ $post->id }}
</div>
</div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
<div class="text-sm font-medium text-gray-900">
  <a href="/posts/{{ $post->id }}">
    {{ $post->title }}
</a>
</div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
  <a href="/admin/posts/{{ $post->id }}/edit" class="text-pink-600 hover:text-pink-800">Edit</a>
</td>
<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
<form method="POST" action="/admin/posts/{{ $post->id }}">
@csrf
@method ('DELETE')
<button onclick="return confirm('Are you sure?')" class="text-xs text-red-600 border border-red-600 rounded p-2">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</section>
</div>
</main>
</body>
</html>
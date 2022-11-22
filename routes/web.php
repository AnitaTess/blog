<?php

use\App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserDashController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('posts/{post}', function ($id) {
    return view('post', ['post' => Post::findOrFail($id)]);
});

Route::get('admin/posts/allposts', function () {
    return view('admin/posts/allposts');
});

Route::post('posts/{post:id}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create']);
Route::post('sessions', [SessionController::class, 'store']);
Route::post('logout', [SessionController::class, 'destroy']);

Route::get('admin/posts/allposts', [AdminPostController::class, 'allposts']);
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);

Route::get('admin/users/{user}/useredit', [AdminUserController::class, 'useredit']);
Route::patch('admin/users/{user}', [AdminUserController::class, 'update']);
Route::get('admin/posts/allusers', [AdminUserController::class, 'allusers']);
Route::delete('admin/users/{user}', [AdminUserController::class, 'destroy']);

Route::get('admin/posts/create', [PostController::class, 'create']);
Route::post('admin/posts', [PostController::class, 'store']);

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('showuser', [UserDashController::class, 'myuser']);
Route::post('showuser', [UserDashController::class, 'updatePassword'])->name('update-password');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\RequestLikeController;
use App\Http\Controllers\FollowersListController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserPostsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.add');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'add'])->name('register.add');

Route::middleware(['auth.user'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [ProfileController::class, 'update'])->name('update-profile');

    Route::post('/showAddPosts', [PostController::class, 'showAddPosts'])->name('showAddPosts');

    Route::post('/add-post', [PostController::class, 'addPost'])->name('add-post');

    Route::post('/search', [UserController::class, 'search'])->name('search');

    Route::post('/likes/{post_id}', [LikesController::class, 'like'])->name('likes');

    Route::get('/followersListforProfile', [FollowersListController::class, 'followersListforProfile'])->name('followersListforProfile');

    Route::get('/followersList/{id}', [FollowersListController::class, 'followersList'])->name('followersList');

    Route::get('/followingList/{id}', [FollowersListController::class, 'followingList'])->name('followingList');

    Route::get('/followingListforProfile', [FollowersListController::class, 'followingListforProfile'])->name('followingListforProfile');

    Route::post('/reqLikes/{post_id}', [RequestLikeController::class, 'reqLike'])->name('reqLike');

    Route::get('/notificationsLike', [RequestLikeController::class, 'reqLikeRes'])->name('notificationsLike');

    Route::post('/save/{post_id}', [SaveController::class, 'save'])->name('save');

    Route::get('/userProfile/{id}', [UserController::class, 'showUserProfile']);

    Route::post('/userProfile/{id}', [UserController::class, 'showUserProfile'])->name('userProfile');

    Route::get('/request/{id}', [RequestController::class, 'request'])->name('request');

    Route::get('/chats/{id}', [MessagesController::class, 'chats'])->name('chats');

    Route::post('/userPosts/{id}', [UserPostsController::class, 'userPosts'])->name('userPosts');

    Route::post('/myPosts', [UserPostsController::class, 'myPosts'])->name('myPosts');

    Route::get('/deletePosts/{post_id}', [UserPostsController::class, 'deletePost'])->name('deletePosts');



    Route::post('/sendMessages/{id}', [MessagesController::class, 'sendMessages'])->name('sendMessages');

    Route::get('/notifications', [RequestController::class, 'index'])->name('notifications.index');

    Route::get('/confirm/{id}', [RequestController::class, 'confirm']);
    Route::get('/delete/{id}', [RequestController::class, 'delete']);

    Route::get('/index', [IndexController::class, 'showIndex'])->name('index');

    Route::get('/email-reset', [PasswordResetController::class, 'showResetForm'])->name('email-reset');
    Route::post('/password-email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password-email');
    Route::get('/password-reset', [ResetPasswordController::class, 'showResetForm'])->name('password-reset');
    Route::post('/password.reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
});

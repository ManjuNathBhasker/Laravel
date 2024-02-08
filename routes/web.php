<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\PostDec;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('post.index');
});

Route::get('post/trash', [PostController::class, 'trash'])->name('post.trash');

Route::get('post/{id}/restore', [PostController::class, 'restore'])->name('post.restore');

Route::get('post/{id}/forceDelete', [PostController::class, 'forceDelete'])->name('post.forceDelete');

Route::get('post/{id}/duplicate', [PostController::class, 'duplicate'])->name('post.duplicate');

Route::resource('post', PostController::class);

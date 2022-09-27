<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;



Route::get('/',[PostController::class,'create'])->name('post#home');
Route::post('/createPost', [PostController::class,'createPost'])->name('createPost');

Route::get('post/delete/{id}',[PostController::class,'deletePost'])->name('deletePost');

Route::get('post/updatePage/{id}',[PostController::class,'updatePage'])->name('updatePage');
Route::get('post/editPage/{id}',[PostController::class,'editPage'])->name('editPage');
Route::post('post/saveEdit/{id}',[PostController::class,'saveEdit'])->name('saveEdit');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;

Route::get('/all', [PostController::class, 'index'])->name('rest.show.all');
Route::post('/create', [PostController::class, 'store'])->name('rest.create');
Route::put('/update/{id}', [PostController::class, 'update'])->name('rest.update');
Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('rest.delete');

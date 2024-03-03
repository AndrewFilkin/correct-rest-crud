<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;

Route::get('/all', [PostController::class, 'index'])->name('rest.show.all');

<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
Route::get('/category/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])
    ->name('categories.show');

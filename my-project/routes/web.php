<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;



Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::post('/article', [ArticleController::class, 'store'])->name('articles.store');
Route::put('/article/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

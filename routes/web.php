<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogController;

Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');

Route::get('/group/{group}', [GroupController::class, 'show'])->name('group.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

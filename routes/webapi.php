<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes

// Categories
Route::get("/categories", [CategoryController::class, "index"]);
Route::get("/categories/{slug}", [CategoryController::class, "showBySlug"]);

// Products
Route::get("/products", [ProductController::class, "index"]);
Route::get("/products/{id}", [ProductController::class, "showById"]);

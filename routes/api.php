<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleChannelItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post("/login", [AuthController::class, "login"]);

/**
 * When you want to register a new user, you can uncomment the following line
 *
 * Note: this enpoint is open for the vulnerability of the application. So you should comment it after you register a new user.
 */
Route::post("/register", [AuthController::class, "register"]);

// Protected Routes
Route::group(
    ["middleware" => ["auth:sanctum"]],
    function () {
        Route::post("/logout", [AuthController::class, "logout"]);
        Route::resource("/categories", CategoryController::class);
        Route::post("/products/priceUpdate", [ProductController::class, "bulkPriceUpdate"]);
        Route::resource("/products", ProductController::class);
        Route::resource("/medias", MediaController::class);
        Route::resource("/customers", CustomerController::class);
        Route::post("/orders/createneworder", [OrderController::class, "createNewOrder"]);
        Route::resource("/orders", OrderController::class);
        Route::get("/salechannelitems/getWithOrders", [SaleChannelItemController::class, "getSaleChannelItemsWithOrders"]);
        Route::resource("/salechannelitems", SaleChannelItemController::class);
    }
);

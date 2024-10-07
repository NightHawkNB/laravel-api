<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/suppliers/get", [SupplierController::class, "getAll"]);
Route::get("/suppliers/get/{id}", [SupplierController::class, "getOne"]);
Route::get("/suppliers/getAll", [SupplierController::class,"getAllPaginated"]);
Route::post("/suppliers/create", [SupplierController::class, "create"]);
Route::patch("/suppliers/update/{id}", [SupplierController::class, "update"]);
Route::delete("/suppliers/delete/{id}", [SupplierController::class, "delete"]);
Route::get("/suppliers/search", [SupplierController::class, "search"]);

Route::get('/products/getAll', [ProductController::class, 'getAll']);
Route::get('/products/get/sup/{id}', [ProductController::class, 'getBySupplierId']);
Route::patch('/products/update/{id}', [ProductController::class, 'update']);
Route::delete('/products/delete/{id}', [ProductController::class, 'delete']);

//* Tesitng endpoints
Route::post('/products/createMultiple/{id?}', [ProductController::class, 'createMultiple']);
Route::post('/products/create/{id?}', [ProductController::class, 'create']);


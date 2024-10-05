<?php

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
Route::post("/suppliers/search", [SupplierController::class, "search"]);

// Route::get('/products/get/{id}')

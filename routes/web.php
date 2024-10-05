<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "Testing API";
});


Route::get("/db-connection", function() {
    return view("db");
});

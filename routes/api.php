<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::post("/add", [RequestController::class, "add"])->name("add.request");

Route::get("/fuel-requests", [RequestController::class, "getAll"])->name("fuel.request");

Route::get("/fuel-history", [RequestController::class, "history"])->name("fuel.history");

Route::post("/approve/{id}", [RequestController::class, "approve"])->name("request.approve");

Route::post("/reject/{id}", [RequestController::class, "reject"])->name("request.reject");

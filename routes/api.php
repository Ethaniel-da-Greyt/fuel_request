<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::post("/add", [RequestController::class, "add"])->name("add.request");

Route::get("/fuel-requests", [RequestController::class, "getAll"])->name("fuel.request");

Route::post("/approve/{id}", [RequestController::class, "approve"])->name("fuel.request");

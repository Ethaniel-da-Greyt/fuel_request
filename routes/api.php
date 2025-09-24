<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("/add", [RequestController::class, "add"])->name("add.request"); //add request

Route::get("/fuel-requests", [RequestController::class, "getAll"])->name("fuel.request"); //fuel request record fetch all

Route::get("/fuel-history", [RequestController::class, "history"])->name("fuel.history"); //fuel history approved and rejected records

Route::get("/approve/{id}", [RequestController::class, "approve"])->name("request.approve"); //approve request api endpoint

Route::get("/reject/{id}", [RequestController::class, "reject"])->name("request.reject"); //reject request api endpoint

Route::post("/add-user", [UserController::class, 'store'])->name('add.user'); //add user api endpoint

Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update.user'); //update user

Route::post('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete.user'); //delete user

Route::post('/fetch-user/{id}', [UserController::class, 'fetchUser'])->name('fetch.user'); //fetch user by ID

Route::post('/fetch-users', [UserController::class, 'fetchAllUser'])->name('fetchAll.user'); //fetch all users


Route::post("/signup", [SignUpController::class, 'signUp']); //signup user

Route::post("/login", [LoginController::class, 'login'])->name('login.user'); //login user

Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');//logout

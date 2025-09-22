<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/testing', function () {
    Mail::to(["ethanielobordo2001@gmail.com", "etanyelgwapo@gmail.com", "jeromebringuez@gmail.com"])->send(new TestMail());

    return "Email has Sent";
});

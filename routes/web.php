<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;


Route::view('/','home')->name('home');

/*
  admin routes 
*/
Route::prefix('admin')->group(function(){
    Route::get('/signup',[AuthenticationController::class,'adminSignupForm'])->name('adminSignupForm');
    Route::post('/signup',[AuthenticationController::class,'adminSignup'])->name('adminSignup');
});


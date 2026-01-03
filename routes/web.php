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
    Route::get('/login',[AuthenticationController::class,'adminLoginForm'])->name('adminLoginForm');
    Route::post('/login',[AuthenticationController::class,'adminLogin'])->name('adminLogin');
    Route::middleware(['admin.auth'])->group(function(){
      Route::get('/dashboard',[AuthenticationController::class,'adminDashboard'])->name('adminDashboard');
    });
});


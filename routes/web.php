<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::view('/','home')->name('home');

/*
  admin routes 
*/
Route::prefix('admin')->group(function(){
    Route::get('/signup',[AuthenticationController::class,'signupForm'])->name('adminSignupForm');
    Route::post('/signup',[AuthenticationController::class,'signUp'])->name('adminSignup');
    Route::get('/login',[AuthenticationController::class,'loginForm'])->name('adminLoginForm');
    Route::post('/login',[AuthenticationController::class,'login'])->name('adminLogin');
    Route::middleware(['admin.auth'])->group(function(){
      Route::post('/logout',[AuthenticationController::class,'logout'])->name('adminLogout');
      Route::get('/dashboard',[AuthenticationController::class,'dashboard'])->name('adminDashboard');

      // product management routes with admin restrictions
      Route::prefix('product')->group(function(){
        Route::get('/',[ProductController::class,'index'])->name('productForm');
        Route::post('/',[ProductController::class,'createProduct'])->name('createProduct');
        Route::get('/update/{id}',[ProductController::class,'updateProductForm'])->name('updateProductForm');
        Route::put('/update/{id}',[ProductController::class,'updateProduct'])->name('updateProduct');
        Route::delete('/',[ProductController::class,'deleteProduct'])->name('deleteProduct');
      });
      // end of product management routes
    });
});

Route::prefix('customer')->group(function(){
    Route::get('/signup',[AuthenticationController::class,'signupForm'])->name('customerSignupForm');
    Route::post('/signup',[AuthenticationController::class,'signUp'])->name('customerSignup');
    Route::get('/login',[AuthenticationController::class,'loginForm'])->name('customerLoginForm');
    Route::post('/login',[AuthenticationController::class,'login'])->name('customerLogin');
    Route::middleware(['customer.auth'])->group(function(){
      Route::post('/logout',[AuthenticationController::class,'logout'])->name('customerLogout');
      Route::get('/dashboard',[AuthenticationController::class,'dashboard'])->name('customerDashboard');
    });
});


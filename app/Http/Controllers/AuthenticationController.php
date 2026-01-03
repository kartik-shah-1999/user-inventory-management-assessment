<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function adminSignupForm(){
        return view('authentication-templates.admin.signup');
    }

    public function adminSignup(SignupRequest $request){
        $data = $request->only('name','email','pass1','pass2');
        try {
            $user = Admin::create([
                'uuid' => Str::uuid(),
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['pass1']),
            ]);
            Auth::guard('admin')->login($user);
            return redirect()->route('adminDashboard');
        } catch (\Exception $e) {
            Log::error('Admin signup failed: ' . $e->getMessage());
            return back()->withErrors('Error processing the request. Please try again later.');
        }
    }

    public function adminLoginForm(){
        return view('authentication-templates.admin.login');
    }

    public function adminLogin(LoginRequest $request){
        $creds = Auth::guard('admin')->attempt($request->only('email','password'));
        if(!$creds){
            return back()->withErrors('Invalid credentials');
        }
        return redirect()->intended(route('adminDashboard'),'200');
    }

    public function adminDashboard(){
        return view('authentication-templates.admin.dashboard');
    }
}

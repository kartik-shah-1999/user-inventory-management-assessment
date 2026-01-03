<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\Admin;
use App\Models\Customer;
use App\UserRoleEnum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    protected $guard;

    public function __construct(){
        $this->guard = getGuard();
    }
    protected function getModelFromGuard(){
        $model = match($this->guard){
            UserRoleEnum::ADMIN => Admin::class,
            UserRoleEnum::CUSTOMER => Customer::class
        };
        return $model;
    }
    public function signupForm(){
        return view('authentication-templates.'.$this->guard.'.signup');
    }

    public function signUp(SignupRequest $request){
        $data = $request->only('name','email','pass1','pass2');
        try {
            $user = self::getModelFromGuard()::create([
                'uuid' => Str::uuid(),
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['pass1']),
            ]);
            Auth::guard($this->guard)->login($user);
            return redirect()->route($this->guard.'Dashboard');
        } catch (\Exception $e) {
            Log::error($this->guard.' signup failed: ' . $e->getMessage());
            return back()->withErrors('Error processing the request. Please try again later.');
        }
    }

    public function loginForm(){
        return view('authentication-templates.'.$this->guard.'.login');
    }

    public function login(LoginRequest $request){
        $creds = Auth::guard($this->guard)->attempt($request->only('email','password'));
        if(!$creds){
            return back()->withErrors('Invalid credentials');
        }
        return redirect()->route($this->guard.'Dashboard');
    }

    public function dashboard(){
        return view('authentication-templates.'.$this->guard.'.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function adminSignupForm(){
        return view('authentication-templates.admin.signup');
    }

    public function adminSignup(AdminRequest $request){
        $data = $request->only('name','email','pass1','pass2');
        $user = Admin::create([
            'uuid' => uuid_create(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['pass1'])
        ]);

        if(!$user){
            return back()->withErrors('Error processing the request. Please try again later.');
        }
        Auth::guard('admin')->login($user);
        return back()->with('message','User created successfully');
    }
}

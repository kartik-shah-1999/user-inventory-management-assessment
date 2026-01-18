<?php

use App\UserRoleEnum;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::routes(['middleware' => ['auth:admin']]);

Broadcast::channel('users', function ($user) {
    $guard = null;
    if(auth(UserRoleEnum::ADMIN)->check()){
        $guard = UserRoleEnum::ADMIN;
    }
    else if(auth(UserRoleEnum::CUSTOMER)->check()){
        $guard = UserRoleEnum::CUSTOMER;
    }
    $user = auth($guard)->user();
    return['user' => [
            'id' => $user->uuid,
            'name' => $user->name,
            'email' => $user->email,
            'last_seen' => $user->last_seen_at
        ], 'role' => $guard];
},['guards' => [UserRoleEnum::ADMIN, UserRoleEnum::CUSTOMER]]);
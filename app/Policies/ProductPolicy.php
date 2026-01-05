<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\UserRoleEnum;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Auth\Authenticatable;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?Authenticatable $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?Authenticatable $user, Product $product): bool
    {
        // if (!auth()->guard(UserRoleEnum::ADMIN)->check()) return false;
        // return $product->created_by === auth()->guard('admin')->user()->uuid;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?Authenticatable $user): bool
    {   
        return auth(UserRoleEnum::ADMIN)->check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?Authenticatable $user, Product $product): bool
    {
        if (!auth()->guard(UserRoleEnum::ADMIN)->check()) return false;
        return $product->created_by === auth()->guard('admin')->user()->uuid;
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?Authenticatable $user, Product $product): bool
    {
        if (!auth()->guard(UserRoleEnum::ADMIN)->check()) return false;
        return $product->created_by === auth()->guard(UserRoleEnum::ADMIN)->user()->uuid;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?Authenticatable $user, Product $product): bool
    {
        if (!auth()->guard(UserRoleEnum::ADMIN)->check()) return false;
        return $product->created_by === auth()->guard(UserRoleEnum::ADMIN)->user()->uuid;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(?Authenticatable $user, Product $product): bool
    {
        if (!auth()->guard(UserRoleEnum::ADMIN)->check()) return false;
        return $product->created_by === auth()->guard(UserRoleEnum::ADMIN)->user()->uuid;
    }
}

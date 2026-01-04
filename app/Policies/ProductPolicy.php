<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return auth()->guard('admin')->check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Product $product): bool
    {
        if (!auth()->guard('admin')->check()) return false;
        return $product->created_by === auth()->guard('admin')->user()->uuid;
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Product $product): bool
    {
        if (!auth()->guard('admin')->check()) return false;
        return $product->created_by === auth()->guard('admin')->user()->uuid;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Product $product): bool
    {
        if (!auth()->guard('admin')->check()) return false;
        return $product->created_by === auth()->guard('admin')->user()->uuid;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Product $product): bool
    {
        if (!auth()->guard('admin')->check()) return false;
        return $product->created_by === auth()->guard('admin')->user()->uuid;
    }
}

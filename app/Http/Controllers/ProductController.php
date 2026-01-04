<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\UserRoleEnum;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(){
        return view('authentication-templates.admin.dashboard.productForm');
    }
    public function createProduct(ProductRequest $request){
        try{
            if($request->has('image')){
                $fileName = uniqid().'-'.$request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('products',$fileName,'public');
            }
            $product = Product::create([
                    'image' => $path ?? null,
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'created_by' => auth()->guard(UserRoleEnum::ADMIN)->user()->uuid
            ]);
            return redirect()->route('adminDashboard')->with('success','Product created successfully');
        }catch(Exception $e){
            Log::error('Error in creating the product: '.$e->getMessage());
            return redirect()->route('adminDashboard')->with('error','Error in processing the request. Try again later');
        }
        // if(!$product){}
    }
}

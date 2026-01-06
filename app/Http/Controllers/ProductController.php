<?php

namespace App\Http\Controllers;

use Exception;
use App\UserRoleEnum;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    public function index(){
        return view('authentication-templates.admin.dashboard.productForm');
    }
    public function createProduct(ProductRequest $request){
        try{
            //Policy to ensure only authenticated user with admin guard can perform this operation
            $this->authorizeForUser(auth(UserRoleEnum::ADMIN)->user(),'create', Product::class); 

            if($request->hasFile('image')){
                $fileName = uniqid().'-'.$request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('products',$fileName,'public');
            }
            $product = Product::create([
                    'image' => $path ?? null,
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'category' => $request->input('category') ?? null,
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'created_by' => auth()->guard(UserRoleEnum::ADMIN)->user()->uuid
            ]);
            return redirect()->route('adminDashboard')->with('success','Product created successfully');
        }catch(Exception $e){
            Log::error('Error in creating the product: '.$e->getMessage());
            return redirect()->route('adminDashboard')->with('error','Error in processing the request. Try again later');
        }
    }
    public function updateProductForm($id){
        $product = Product::findOrFail($id);
        return view('authentication-templates.admin.dashboard.updateproduct')->with('product',$product);
    }
    public function updateProduct(ProductRequest $request, $id){
        try{
            $product = Product::findOrFail($id);
            $this->authorizeForUser(auth(UserRoleEnum::ADMIN)->user(), 'update', $product);
            $path = null;
            if($request->hasFile('image')){
                 if(!is_null($product->image) && Storage::disk('public')->exists($product->image)){
                    Storage::disk('public')->delete($product->image);
                }
                $fileName = uniqid().'-'.$request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('products',$fileName,'public');
            }else{
                if(!is_null($product->image)){
                    $path = $product->image;
                }
            }
            $product->update([
                'image' => $path,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category' => $request->input('category') ?? null,
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
            ]);
            return back()->with('success', 'Product updated successfully');
        }catch(Exception $e){
            Log::error('Error in updating the product: '.$e->getMessage());
            return back()->with('error', 'Error in processing the request.');
        }
    }
    public function deleteProduct(){
        try{
            if(request()->filled('id')){
                $product = Product::findOrFail(request()->input('id'));
                $this->authorizeForUser(auth(UserRoleEnum::ADMIN)->user(),'delete',$product);
                $product->delete();
                return response()->json(['success' => 'Product deleted successfully']);
            }
        }catch(Exception $e){
            Log::error('Error in deleting the product: '.$e->getMessage());
            return response()->json(['error' => 'Error in processing the request.']);
        }
    }
}

<?php

namespace App\Http\Controllers\Emporium;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCartRequest;

class ProductController extends Controller
{
    //
    public function show(Request $request)
    {
        $id = $request->product;
        // $product = $this->product->find($id);
        // $product = Product::with(['store'])->findOrFail($id);
        $product = Product::findorfail($id);
        if(!$product){
            return redirect()->route('error', ['code' => 404, 'message' => 'Product Not Found']);
        }

        $store = Store::findorfail($product->store_id);
        // $variants = $product->variants->count() > 0 ? $product->variants : [];
        // $discount = $product->discount ? $product->discount : null;

        $data = [
            'product' => $product,
            'store' => $store ? ['name' => $store->name, 'id' => $store->id] : 'No Store',
            // 'variants' => $variants,
            // 'discount' => $discount
        ];
        // dd($data);
        return $this->render('Emporium/Product', $data);
    }

    public function addtocart(CreateCartRequest $request)
    {
        $id = $request->product;
        $validated = $request->validated();
        if($this->user()){
            $user = $this->user();
            $product = Product::findorfail($id);
            if($product){
                $cartitem = $user->cart()->create($validated);
            }
            return redirect()->route('error', ['code' => 404, 'message' => 'Product Not Found']);
        }
        return redirect()->route('login');
    }
}

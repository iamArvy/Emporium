<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Store\StoreController;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;

class ProductController extends StoreController
{
    
    public function index()
    {
        $products = $this->store->products();
        // dd($products);
        return $this->render('Store/Dashboard', [
            'title' => 'Dashboard',
            'products'=> $products
        ]);
    }

    public function show(Product $product)
    {
        // dd($product);
        // $product->load('variants');
        $data = [
            'title' => 'Product',
            'product'=> $product
        ];
        return response()->json($data);
        // return $this->render('Store/Product', [
        //     'title' => 'Product',
        //     'product'=> $product
        // ]);
    }

    public function create(CreateProductRequest $request)
    {

        $validated = $request->validated();
        
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product-images', 'public');
                $imagePaths[] = 'storage/'.$path;
            }
        }
        $validated['images'] = $imagePaths;
        $product = $this->store->products()->create($validated);
        // return redirect()->route('store.products');
        return response()->json(['message'=>'Product add successfully']);
    }

    public function createVariants(Request $request, Product $product)
    {
        $validated = $request->validated();
        foreach ($validated['variants'] as $item){
            $variant = $product->variants()->create($item);
        }
        // $variant = $product->variants()->create($validated);

    }
}

<?php

namespace App\Http\Controllers\Emporium;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCartRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function show(Request $request)
    {
        $id = $request->product;
        try {
            $product = $this->productService->getProductWithRelationships($id, ['store']);
            return $this->render('Emporium/Product', $product);
        } catch (\Exception $e) {
            return redirect()->route('error', ['code' => 404, 'message' => 'Product Not Found']);
        }
    }

    public function addtocart(CreateCartRequest $request)
    {
        // dd('here');
        $validated = $request->validated();
        // dd($validated);
        $id = $validated['product_id'];
        $user = $this->user();
        try {
            $this->productService->addtocart($user, $validated);
        } catch (\Exception $e) {
            if($e->getCode = 403){
                // return redirect()->route('login');
                dd($e);
            }
            return redirect()->route('error', ['code' => 404, 'message' => 'Product Not Found']);

        }
    }
}

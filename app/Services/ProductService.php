<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    private function getOrderNumber(){
        $year = date('Y');
        // return 'ORD-' . $year . '-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
        return $year;
    }

    public function getProductWithRelationships(string $id, array $relationships){
        $product = $this->productRepo->findProductWithRelationships($id, $relationships);
        if(!$product){
            throw new Exception("Error Processing Request", 1);
        }
        return ['product' => $product];
    }

    public function addtocart($user, $data){
        if(!$user){
            throw new Exception("Error Processing Request", 1);
            die;
        }
        $product = $this->productRepo->find($data['product_id']);
        if(!$product){
            throw new Exception('Product not found');
            die;
        }
        $user->cart()->create($data);
    }

    public function uploadImages($images){
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product-images', 'public');
                $imagePaths[] = 'storage/'.$path;
            }
        }
    }
    public function create($store, $data)
    {
        $this->productRepo->create($store, $data);
    }
    
}
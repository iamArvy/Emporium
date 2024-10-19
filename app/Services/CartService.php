<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getCartItems($user)
    {
        $productRepository = app(ProductRepository::class);
        $cartItems = $user->cart()->get();
        $productIds = $cartItems->pluck('product_id')->toArray();
        $products = $productRepository->getProductsByIds($productIds);
        foreach ($cartItems as $item) {
            $item->product = $products->get($item->product_id);
            $item -> total_price = $item->quantity * $item->product->price;
        }
        return [
            'items' => $cartItems,
            'total' => $cartItems->sum('total_price'),
            'quantity' => $cartItems->sum('quantity'),
        ];  
    }

    public function findProduct($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}

<?php

namespace App\Services;

use App\Services\Service;
use App\Repositories\CartRepository;

class CartService extends Service
{
    protected $cartRepo;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function getCartItems($user)
    {
        $items = $this->cartRepo->all($user);
        $data = [
            'items' => $items,
            'total' => $items->sum('total_price'),
            'quantity' => $items->sum('quantity'),
        ];
        return $data;
    }

    public function get($id)
    {
        return $this->cartRepo->find($id);
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

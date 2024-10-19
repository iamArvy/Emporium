<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use CartService;
class OrderService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    private function getOrderNumber(){
        $year = date('Y');
        // return 'ORD-' . $year . '-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
        return $year;
    }

    public function createOrderItems($items, $order){
        foreach($items as $item){
            $data = [
                'product_id' => $item->product->id,
                'product_name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'total' => $item->total_price
            ];
            $order->items()->create($data);
        }
    }
    public function create($total, $quantity, array $validated)
    {
        $orderNumber = $this->getOrderNumber();
        $validated['order_number'] = $orderNumber;
        $validated['total'] = $total;
        $validated['quantity'] = $quantity;
        $order = $this->user()->orders()->create($validated);
        return $order;        
    }

    public function all($user)
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

    public function get($id){

    }

    public function getItems($order){

    }
    
}

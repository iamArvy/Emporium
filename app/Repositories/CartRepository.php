<?php
namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function all($user)
    {
        $items = $user->cart()->get();
        foreach ($items as $item) {
            $item->product = $item->product();
            $item -> total_price = $item->quantity * $item->product->price;
        }
        return $items;
    }

    public function find($id)
    {
        return Cart::findOrFail($id);
    }


    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product->delete();
    }
}

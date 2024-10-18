<?php

namespace App\Http\Controllers\Emporium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\CreateCartRequest;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = $this->user()->cart;
        return $this->render('Emporium/Cart', $cart);
    }

    public function create(CreateCartRequest $request)
    {
        $id = $request->product;
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('error', ['code' => 404, 'message' => 'Product Not Found']);
        }

        $validated = $request->validated();
        $cartitem = $this->user()->cart()->create($validated);

        if ($cartitem) {
            return redirect()->route('cart.index')->with('success', 'Item added to cart.');
        }

        return back()->withErrors(['error' => 'Failed to add item to cart.']);
    }

    public function update(Request $request)
    {
        $id = $request->cart;
        $cart = $this->user()->cart()->find($id);

        if (!$cart) {
            return redirect()->route('error', ['code' => 404, 'message' => 'Item not found in User Cart']);
        }

        try {
            $validated = $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);
            $cart->update($validated);
            return redirect()->route('cart.index')->with('success', 'Cart item updated successfully.');
        } catch (Error $e) {
            return back()->withErrors(['error' => 'Failed to update cart item.']);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $cart = $this->user()->cart()->find($id);

        if ($cart) {
            $cart->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }

        return redirect()->route('error', ['code' => 404, 'message' => 'Item not found in User Cart']);
    }
}

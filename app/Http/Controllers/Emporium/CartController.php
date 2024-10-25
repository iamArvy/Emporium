<?php

namespace App\Http\Controllers\Emporium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\CreateCartRequest;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartService $cartService)
    {
        // $this->middleware('auth');
        $this->cartService = $cartService;
    }

    public function index()
    {
        try{
            $cart = $this->cartService->getCartItems($this->user());
            return $this->render('Emporium/Cart', $cart);
        }catch(Error $e){
            return back()->withErrors(['error' => 'Failed to get cart items.']);
        }
    }

    public function update(Request $request)
    {
        $id = $request->cart;
        $cart = $this->user()->cart()->find($id);

        if (!$cart) {
            return redirect()->route('error', ['code' => 404, 'message' => 'Item not found in User Cart']);
        }

        try {
            // $this->authorize('update', $cart);
            $validated = $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);
            $cart->update($validated);
            return redirect()->route('cart.index')->with('success', 'Cart item updated successfully.');
        } catch (Error $e) {
            return back()->withErrors(['error' => 'Failed to update cart item.']);
        }
    }

    public function remove(Request $request)
    {
        $id = $request->id;
        $cart = $this->user()->cart()->find($id);

        if ($cart) {
            $cart->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }

        return redirect()->route('error', ['code' => 404, 'message' => 'Item not found in User Cart']);
    }

    public function clear(Request $request)
    {
        $ids = $request->get['ids'];
        foreach ($ids as $id) {
            $cart = $this->user()->cart()->find($id);
            if ($cart) {
                $cart->delete();
            }
        }
        $cart = $this->user()->cart()->find($id);

        if ($cart) {
            $cart->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }

        return redirect()->route('error', ['code' => 404, 'message' => 'Item not found in User Cart']);
    }

    public function checkout(Request $request)
    {
        try{
            $cart = $this->cartService->getCartItems($this->user());
            return $this->render('Emporium/Checkout', $cart);
        }catch(Error $e){
            return back()->withErrors(['error' => 'Failed to get cart items.']);
        }
    }
}

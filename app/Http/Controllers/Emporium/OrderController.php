<?php

namespace App\Http\Controllers\Emporium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    //
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        // $this->middleware('auth');
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->user()->orders;
        return $this->render('Emporium/Orders', $orders);
    }

    public function store(CreateOrderRequest $request)
    {
        $cartService = app(App\Services\CartService::class);
        $validated = $request->validate();
        try{
            $cart = $cartService->getCartItems($this->user());
            $order = $this->orderService->create($cart->total, $cart->quantity, $validated);
            dd($order);
            if($order){
                $order_number = $this->orderService->createOrderNumber();
                $items = $this->orderService->createOrderItems($cart->items, $order);
                $payment = $this->orderService->makePayment($validated[])
                return redirect()->route('emporium.orders.show', $order->id);
            }
        }catch(Error $e){

        }
        

    }

    public function show($id)
    {
        $order = $this->user()->orders()->findOrFail($id);
        return $this->render('Emporium/Orders/Show', $order);
    }

    public function edit($id)
    {
        $order = $this->user()->orders()->findOrFail($id);
        return $this->render('Emporium/Orders/Edit', $order);
    }

    public function update(Request $request, $id)
    {
        $order = $this->user()->orders()->findOrFail($id);
        $order->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
        ]);

        return redirect()->route('emporium.orders.show', $order->id);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class TestMongoController extends Controller
{
    //
    public function store(Request $request)
{
    $products = Product::all();
    // Product::create([
    //     'name' => 'Test Product',
    //     'price' => 9.99,
    //     'description' => 'This is a test product.'
    // ]);
    dd($products);
}
}

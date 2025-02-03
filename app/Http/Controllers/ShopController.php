<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
{
    // Fetch all products from the database
    $products = Product::all();
    // Pass products to the view
    return view('shop', compact('products'));
}
}

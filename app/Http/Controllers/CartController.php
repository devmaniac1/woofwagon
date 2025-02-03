<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Retrieve cart items from the session
        $cart = session()->get('cart', []);

        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        // Retrieve product by ID
        $product = Product::findOrFail($request->id);

        // Get the cart from the session, or create an empty array if it doesn't exist
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            // Add the product to the cart
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'total' => $product->price,
            ];
        }

        // Update the session with the new cart data
        session()->put('cart', $cart);

        return redirect()->route('shop')->with('success', 'Product added to cart!');
    }

    public function updateCart(Request $request, $id)
{
    $cart = session()->get('cart', []);

 // Ensure the quantity is valid
 $request->quantity = max(1, (int)$request->quantity); // Ensure quantity is at least 1

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $request->quantity;
        $cart[$id]['total'] = $cart[$id]['price'] * $request->quantity;
        session()->put('cart', $cart);
    }

    return redirect()->route('cart')->with('success', 'Cart updated!');
}

public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart')->with('success', 'Item removed from cart!');
}
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get cart data from session
        $cart = session()->get('cart', []);
        $discount = session()->get('discount', 0);  // Retrieve discount from session, default to 0
    
        // Calculate the subtotal (total amount of all items before discount)
        $subTotal = array_reduce($cart, function ($total, $item) {
            return $total + $item['total'];
        }, 0);

        // Format subtotal to 2 decimal points
        $subTotal = number_format($subTotal, 2);
    
        // Calculate the grand total (total after applying the discount)
        $grandTotal = $subTotal - $discount;
    
        return view('checkout', compact('cart', 'discount', 'subTotal', 'grandTotal'));
    }
    
    public function applyDiscount(Request $request)
    {
        $promoCode = $request->input('promo_code');
        $discount = 0;
    
        // Define valid promo code
        $validPromoCode = "SAVE15";
    
        // Check if the promo code is valid
        if ($promoCode === $validPromoCode) {
            $cart = session()->get('cart', []);
            $subTotal = array_reduce($cart, function ($total, $item) {
                return $total + $item['total'];
            }, 0);
    
            // Calculate 15% discount
            $discount = $subTotal * 0.15;
    
            // Store discount in session
            session()->put('discount', $discount);
    
            // Success message if promo code is valid
            return redirect()->route('cart')->with('success', 'Promo Code Applied, Proceed to Checkout');
        } else {
            // Error message if promo code is invalid
            return redirect()->route('cart')->withErrors(['promo_code' => 'Invalid Promo Code']);
        }
    }

    public function checkoutProcess(Request $request)
    {
        $cart = session()->get('cart', []);
        $discount = session()->get('discount', 0);
        
        // Calculate the subtotal and grand total again if needed
        $subTotal = array_reduce($cart, function ($total, $item) {
            return $total + $item['total'];
        }, 0);

        // Format subtotal to 2 decimal points
        $subTotal = number_format($subTotal, 2);

        $grandTotal = $subTotal - $discount;
        
        // Build the products string (product_name|quantity)
    $products = '';
    foreach ($cart as $item) {
        $products .= $item['name'] . '|' . $item['quantity'] . ', ';
    }
        // Clear the cart and discount session
        session()->forget('cart');
        session()->forget('discount');

       // Redirect to home page after order is placed
    return redirect()->route('welcome')->with('success', 'Your order has been placed successfully!');
}
}

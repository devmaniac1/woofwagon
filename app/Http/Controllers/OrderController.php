<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        // Get cart data and discount from session
        $cart = session()->get('cart', []);
        $discount = session()->get('discount', 0);
        
        // If the cart is empty, return an error
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }
        
        // Calculate subtotal and grand total
        $subTotal = array_reduce($cart, function ($total, $item) {
            return $total + $item['total'];
        }, 0);
    
        $grandTotal = $subTotal - $discount;
    
        // Prepare the products as an array for saving
        $products = array_map(function ($item) {
            return [
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['total'],
            ];
        }, $cart);
    
        // Validate the form inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required|in:cash_on_delivery,card_on_delivery',
        ]);
    
        // Create the order and save it to the database
        Order::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'payment_method' => $request->input('payment_method'),
            'discount' => $discount,
            'total' => $grandTotal,
            'products' => json_encode($products),  //  'products' is saved as JSON
            'status' => 'Pending',
        ]);
    
        // Clear the cart and discount session
        session()->forget('cart');
        session()->forget('discount');
        
    
       // Redirect to home page after order is placed
    return redirect()->route('welcome')->with('success', 'Your order has been placed successfully!');
    }

    public function viewOrders()
{
    $orders = Order::orderBy('created_at', 'asc')->get(); // Fetch orders, past first
    return view('admin.viewOrders', compact('orders')); // Pass data to the Blade file
}

// Ensure updating the status with one of the valid options
public function updateOrderStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Ensure the status value is valid
    $request->validate([
        'status' => 'required|in:Pending,Delivered,Cancelled',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('status', 'Order status updated successfully!');
}

public function viewPastOrders()
    {
        // Fetch only the necessary columns
        $orders = Order::select('id', 'created_at', 'total', 'payment_method', 'status', 'products')
                       ->where('email', auth()->user()->email) // Fetch only the logged-in user's orders
                       ->orderBy('created_at', 'asc')
                       ->get();

        return view('viewPastOrders', compact('orders'));
    }
}

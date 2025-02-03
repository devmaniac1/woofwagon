<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>WoofWagon</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg max-w-4xl">
        <h1 class="text-2xl md:text-4xl font-extrabold text-center text-gray-800 mb-6">Shopping Cart</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

                @if($errors->has('promo_code'))
            <div class="bg-red-100 text-red-800 p-4 mb-6 rounded-lg shadow">
                {{ $errors->first('promo_code') }}
            </div>
        @endif
        
        @if(!empty($cart))
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 text-sm md:text-base">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-3 px-2 md:px-4 text-left border-b border-gray-300">Product</th>
                            <th class="py-3 px-2 md:px-4 text-left border-b border-gray-300">Price</th>
                            <th class="py-3 px-2 md:px-4 text-left border-b border-gray-300">Quantity</th>
                            <th class="py-3 px-2 md:px-4 text-left border-b border-gray-300">Total</th>
                            <th class="py-3 px-2 md:px-4 text-left border-b border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 px-2 md:px-4 border-b border-gray-300">{{ $item['name'] }}</td>
                                <td class="py-4 px-2 md:px-4 border-b border-gray-300">${{ $item['price'] }}</td>
                                <td class="py-4 px-2 md:px-4 border-b border-gray-300">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-12 md:w-16 text-center border border-gray-400 rounded py-1">
                                        <button type="submit" class="bg-blue-500 text-white font-bold px-2 py-1 rounded hover:bg-blue-600">Update</button>
                                    </form>
                                </td>
                                <td class="py-4 px-2 md:px-4 border-b border-gray-300">${{ $item['price'] * $item['quantity'] }}</td>
                                <td class="py-4 px-2 md:px-4 border-b border-gray-300">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-bold hover:underline hover:text-red-800">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col gap-4">
    <p class="text-lg md:text-xl font-bold text-gray-700">
        Grand Total:
        <span id="grand-total" class="text-green-600">
            ${{ array_reduce($cart, fn($total, $item) => $total + ($item['price'] * $item['quantity']), 0) }}
        </span>
    </p>

    <div class="mt-4">
    <label for="promo-code" class="block text-gray-700 font-bold mb-2">Have a Promo Code?</label>
    <form action="{{ route('applyDiscount') }}" method="POST" class="flex items-center gap-2">
        @csrf
        <input type="text" id="promo-code" name="promo_code" class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg" placeholder="Enter Promo Code">
        <button type="submit" class="bg-blue-600 text-white font-bold px-4 py-2 mt-2 rounded-lg hover:bg-blue-700">
            Apply Promo Code
        </button>
    </form>
</div>


        @else
            <p class="text-center text-gray-500 text-lg mt-8">Your cart is empty!</p>
            <div class="flex justify-center mt-4">
                <a href="{{ route('shop') }}" class="bg-green-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-lg hover:bg-green-700">
                    Continue Shopping
                </a>
            </div>
        @endif

        @if(!empty($cart))
            <div class="flex justify-between mt-6 flex-wrap gap-4">
                <a href="{{ route('shop') }}" class="bg-yellow-600 text-white font-bold px-4 md:px-6 py-2 md:py-3 rounded-lg hover:bg-yellow-700">Continue Shopping</a>
                <a href="{{ route('checkOut') }}" class="bg-green-600 text-white font-bold px-4 md:px-6 py-2 md:py-3 rounded-lg hover:bg-green-700">Proceed to Checkout</a>
            </div>
        @endif
    </div>
</div>

<!-- Footer Section -->
<footer class="py-10 mt-20 bg-yellow-700">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between">
    <!-- Newsletter Signup -->
<div class="footer-section">
    <h3 class="text-xl font-bold mb-4">Newsletter Signup</h3>
    <p class="mb-4">Stay updated with our latest news and offers.<br> Subscribe to our newsletter!</p>
    <form action="#" method="post" class="newsletter-form flex flex-col space-y-2">
        <input type="email" name="email" placeholder="Enter your email" class="p-2 rounded w-full max-w-xs" required>
        <button type="submit" class="px-3 py-1 bg-yellow-600 text-white rounded w-full max-w-xs hover:bg-yellow-500 transition duration-300">Subscribe</button>
    </form>
</div>

        <!-- Quick Links -->
        <div class="footer-section">
            <h3 class="text-xl font-bold mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="#" class="text-black hover:text-yellow-600 transition duration-300">Home</a></li>
                <li><a href="#" class="text-black hover:text-yellow-600 transition duration-300">Shop</a></li>
                <li><a href="#" class="text-black hover:text-yellow-600 transition duration-300">Services</a></li>
                <li><a href="#" class="text-black hover:text-yellow-600 transition duration-300">Account</a></li>
                <li><a href="#" class="text-black hover:text-yellow-600 transition duration-300">Contact Us</a></li>
            </ul>
        </div>

        <!-- Contact Us -->
        <div class="footer-section">
            <h3 class="text-xl font-bold mb-4">Contact Us</h3>
            <ul class="space-y-2">
                <li>Email: support@WoofWagon.com</li>
                <li>Phone: (123) 456-7890</li>
                <li>Address: 123 Pet Lane, colombo 3</li>
            </ul>
        </div>
    </div>
        <div class="text-center mt-8 border-t border-gray-400 pt-4">
            <p>&copy; 2024 WoofWagon. All rights reserved.</p>
            <nav class="mt-2">
                <a href="#" class="text-black hover:text-amber-600 hover:underline mx-2 transition">Privacy Policy</a>
                <a href="#" class="text-black hover:text-amber-600 hover:underline mx-2 transition">Terms of Service</a>
            </nav>
        </div>
    </div>
</footer>
</body>
</html>

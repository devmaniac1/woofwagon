<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg max-w-4xl">
        <h1 class="text-2xl md:text-4xl font-extrabold text-center text-gray-800 mb-6">Checkout</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('order.create') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" required class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Full Name">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Email Address">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="phone" class="block text-gray-700 font-bold mb-2">Phone</label>
                    <input type="text" id="phone" name="phone" required class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Phone Number">
                </div>

                <div>
                    <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                    <textarea id="address" name="address" required class="w-full p-3 border border-gray-300 rounded-lg" rows="4" placeholder="Shipping Address"></textarea>
                </div>
            </div>

            <div class="mt-6">
                <label for="payment_method" class="block text-gray-700 font-bold mb-2">Payment Method</label>
                <select id="payment_method" name="payment_method" class="w-full p-3 border border-gray-300 rounded-lg">
                    <option value="">Select Payment Method</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                    <option value="card_on_delivery">Card on Delivery</option>
                </select>
            </div>

            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800">Cart Summary</h2>
                @foreach($cart as $id => $item)
                    <div class="flex justify-between mt-2">
                        <p>{{ $item['name'] }} (x{{ $item['quantity'] }})</p>
                        <p>${{ $item['total'] }}</p>
                    </div>
                @endforeach

                <div class="flex justify-between mt-4">
                    <p class="font-bold text-gray-700">Subtotal:</p>
                    <p class="text-green-600">${{ $subTotal }}</p>
                </div>

                @if($discount > 0)
                    <div class="flex justify-between mt-2">
                        <p class="font-bold text-gray-700">Discount:</p>
                        <p class="text-red-600">- ${{ $discount }}</p>
                    </div>
                @endif

                <div class="flex justify-between mt-4 border-t pt-4">
                    <p class="font-bold text-gray-700">Total:</p>
                    <p class="text-green-600">${{ $grandTotal }}</p>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

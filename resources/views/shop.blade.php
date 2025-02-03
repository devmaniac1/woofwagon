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
<body>

<!-- Navbar -->
<nav class="bg-yellow-800 p-2 shadow-md" x-data="{ open: false }" aria-label="Main Navigation">
    <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="text-2xl font-bold text-white">
        <a href="#" id="logo" class="flex items-center ml-4">
                <img src="images/LG.png" alt="Logo" class="h-12 md:h-20">
            </a>
        </div>

        <!-- Hamburger Icon -->
        <div class="sm:hidden">
            <button @click="open = !open" class="text-white focus:outline-none">
                <!-- Icon changes based on the 'open' state -->
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Links - Hidden on small screens, shown on larger screens -->
        <div class="hidden sm:flex space-x-6 text-white font-semibold">
        <a href="{{ route('welcome') }}" class="text-white hover:underline">Home</a>
            <a href="{{ route('shop') }}" class="text-white hover:underline">Shop</a>
            <a href="{{ route('services') }}" class="text-white hover:underline">Our Services</a>
        </div>

        <!-- Icons - Hidden on small screens, shown on larger screens -->
        <div class="hidden sm:flex space-x-4 text-white">
            <a href="{{ route('cart') }}" class="btn bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-800"><i class="fa fa-shopping-cart"> Shopping Cart</i></a>
        </div>
    </div>

    <!-- Mobile Menu - Visible when open is true -->
    <div x-show="open" class="sm:hidden">
    <div class="flex flex-col bg-yellow-700 text-white p-4 space-y-2 font-semibold">
        <a href="#" class="text-white hover:underline">Home</a>
        <a href="#" class="text-white hover:underline">Shop</a>
        <a href="#" class="text-white hover:underline">Our Services</a>

        <div class="flex flex-col space-y-2 font-semibold">
        <a href="#" class="btn bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-800"><i class="fa fa-shopping-cart"> Shopping Cart</i></a>
        </div>
    </div>
    
</div>
</nav>

<div class="relative w-full h-72 sm:h-96 lg:h-[30rem] bg-cover bg-center"
     style="background-image: url('images/petFood2.jpg');">
    <!-- Overlay for text -->
    <div class="absolute inset-0 bg-gradient-to-r from-white via-transparent to-transparent"></div>
    
    <!-- Text Content -->
    <div class="absolute inset-0 flex flex-col justify-center items-start pl-8 sm:pl-16 lg:pl-24 text-yellow-900">
    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-4">
        Grab Up to 15% Off On <br> Any Products Till 15th February!!
    </h1>
    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold opacity-90 mb-6">
        Use Promo Code <span class="font-bold text-red-800">SAVE15</span> at Checkout
    </h3>
    </div>
</div>
@if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif
<!-- Product Section -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
    @if(isset($products) && $products->isNotEmpty())
        @foreach ($products as $product)
            <div class="bg-white shadow-lg rounded-md p-4 sm:p-5 flex flex-col items-center">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-40 object-cover rounded-md mb-4">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-md mb-4">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif

                <h2 class="text-lg font-bold text-gray-800 mb-2">{{ $product->name }}</h2>

                <p class="text-sm font-semibold text-yellow-600"><strong>Price:</strong> ${{ $product->price }}</p>

                @if ($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST" class="mt-2 w-full flex justify-center">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="mt-2 w-1/2 bg-yellow-600 text-white font-bold text-xs py-2 px-15 rounded hover:bg-yellow-700">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <p class="text-sm font-bold text-red-600 mt-2">Not Available</p>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-gray-500">No products available.</p>
    @endif
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
        <input type="email" name="email" placeholder="Enter your email" class="p-2 rounded w-full max-w-xs">
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
            <nav class="mt-2" aria-label="Footer Navigation">
                <a href="#" class="text-black hover:text-amber-600 hover:underline mx-2 transition">Privacy Policy</a>
                <a href="#" class="text-black hover:text-amber-600 hover:underline mx-2 transition">Terms of Service</a>
            </nav>
        </div>
    </div>
</footer>

</body>
</html>

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

        <div class="hidden sm:flex space-x-2 text-white font-semibold">
    @if (Route::has('login'))
        @auth
        @if (auth()->user()->user_type === 'admin')
            <a href="{{ url('admin/dashboard') }}" class="btn bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Admin Dashboard</a>
        @else
        <a href="{{ url('/dashboard') }}" class="btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Dashboard</a>
        @endif
        @else
            <a href="{{ route('login') }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-500 transition duration-300">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-4 py-2 bg-yellow-200 text-yellow-800 rounded-lg hover:bg-yellow-300 transition duration-300">Register</a>
            @endif
        @endauth
    @endif
</div>

    </div>

    <!-- Mobile Menu - Visible when open is true -->
    <div x-show="open" class="sm:hidden">
    <div class="flex flex-col bg-yellow-700 text-white p-4 space-y-2 font-semibold">
        <a href="#" class="text-white hover:underline">Home</a>
        <a href="#" class="text-white hover:underline">Shop</a>
        <a href="#" class="text-white hover:underline">Our Services</a>

        <div class="flex flex-col space-y-2 font-semibold">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:underline">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white hover:underline">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
    
</div>
</nav>




  <!-- Main Background Section -->
  <div class="relative w-full h-screen bg-cover bg-center bg-no-repeat overflow-hidden" style="background-image: url('images/home.jpg');">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif
            <div class="absolute inset-0 flex items-center justify-end p-5 md:p-10 bg-black bg-opacity-40">
                <div class="text-right text-white max-w-lg">
                    <h1 class="text-2xl md:text-3xl lg:text-3xl italic mb-4 md:mb-6">Ensuring your Pet's Happiness and</h1>
                    <h2 class="text-xl md:text-2xl lg:text-3xl italic mb-4 md:mb-6">Health with every visit.</h2>
                </div>
            </div>
        </div>

        <section class=" py-16">
  <div class="container mx-auto flex flex-col lg:flex-row items-center px-4 lg:px-0">
    <!-- Image Section -->
    <div class="w-full lg:w-1/2 mb-8 lg:mb-0">
      <img src="images/doggie.jpg" alt="" class="rounded-lg shadow-md mx-auto lg:mx-0">
    </div>

    <!-- Content Section -->
    <div class="w-full lg:w-1/2 lg:ml-8 text-center lg:text-left">
      <h2 class="text-2xl lg:text-3xl font-semibold mb-4">ABOUT US</h2>
      <p class="text-base lg:text-lg mb-6">
        Until one has loved an animal, a part of one's soul remains unawakened.
        We believe in it and we believe in easy access to things that are good for our mind, body and spirit.
        With a clever offering, superb support and a secure checkout you're in good hands.
      </p>
      <ul class="list-disc ml-4 lg:ml-6 mb-6 text-left">
        <li>Over 10 years of experience</li>
        <li>20 talented vets ready to help you</li>
        <li>High-quality products only</li>
      </ul>
      <a href="{{ route('services') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">More about us</a>
    </div>
  </div>
</section>

<section class="bg-yellow-200 py-16 rounded-lg">
  <div class="container mx-auto max-w-screen-xl px-4">
    <h2 class="text-2xl font-bold lg:text-3xl italic text-center mb-8">Top Categories</h2>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
      <!-- Product 1 -->
      <div class="bg-white rounded-lg shadow p-4 hover:scale-105 transition duration-300 ease-in-out">
        <img src="images/food1.png" alt="Chicken Flavour Cookies" class="w-full h-40 object-cover rounded-lg mb-2">
        <h3 class="text-sm font-semibold text-center">Chicken Flavour Cookies</h3>
        <p class="text-xs text-gray-600 text-center">$10</p>
      </div>

      <!-- Product 2 -->
      <div class="bg-white rounded-lg shadow p-4 hover:scale-105 transition duration-300 ease-in-out">
        <img src="images/food2.jpeg" alt="Kibbles and Bites" class="w-full h-40 object-cover rounded-lg mb-2">
        <h3 class="text-sm font-semibold text-center">Kibbles and Bites</h3>
        <p class="text-xs text-gray-600 text-center">$15</p>
      </div>

      <!-- Product 3 -->
      <div class="bg-white rounded-lg shadow p-4 hover:scale-105 transition duration-300 ease-in-out">
        <img src="images/pro2.jpg" alt="Chew Toy" class="w-full h-40 object-cover rounded-lg mb-2">
        <h3 class="text-sm font-semibold text-center">Chew Toy</h3>
        <p class="text-xs text-gray-600 text-center">$6</p>
      </div>

      <!-- Product 4 -->
      <div class="bg-white rounded-lg shadow p-4 hover:scale-105 transition duration-300 ease-in-out">
        <img src="images/food3.jpeg" alt="Pedigree" class="w-full h-40 object-cover rounded-lg mb-2">
        <h3 class="text-sm font-semibold text-center">Pedigree</h3>
        <p class="text-xs text-gray-600 text-center">$12</p>
      </div>

      <!-- Product 5 -->
      <div class="bg-white rounded-lg shadow p-4 hover:scale-105 transition duration-300 ease-in-out">
        <img src="images/product4.jpeg" alt="Dog Robe" class="w-full h-40 object-cover rounded-lg mb-2">
        <h3 class="text-sm font-semibold text-center">Dog Robe</h3>
        <p class="text-xs text-gray-600 text-center">$5</p>
      </div>
    </div>
  </div>
</section>


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
            <nav class="mt-2" aria-label="Footer Navigation">
                <a href="#" class="text-black hover:text-amber-600 hover:underline mx-2 transition">Privacy Policy</a>
                <a href="#" class="text-black hover:text-amber-600 hover:underline mx-2 transition">Terms of Service</a>
            </nav>
        </div>
    </div>
</footer>

</body>
</html>

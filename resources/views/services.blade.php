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

<!-- Main Content -->
 <!-- Services Section -->
<section class="py-10">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold italic mb-6">Our Services</h1>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto mb-12 leading-relaxed"> <!--l-r increses the line height-->
            At WoofWagon, we offer comprehensive vet and grooming services to keep your furry friend happy, healthy, and looking their best.
            From routine check-ups to luxurious grooming, our expert team is here for your pet's every need.
            Book an appointment today and give your beloved companion the care they deserve!
        </p>
    </div>
</section>

<!-- Service Cards Section -->
<section class="py-10">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">

        <div class="md:w-1/2 mb-6 md:mb-0">
            <img src="images/service1.jpg" alt="Animal Hospital" class="rounded-lg shadow-lg w-full">
        </div>

        <div class="md:w-1/2 text-left md:text-right">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-red-600 mb-4">20% OFF Your First Exam</h2>
            <p class="text-lg text-gray-700 font-semibold">at Our Animal Hospital</p>
        </div>
    </div>
</section>

<!--vet-->
<section class="py-10">
    <div class="container mx-auto px-4">
    <h1 class="text-4xl font-extrabold italic mb-12 text-center text-gray-900">Book a Vet Appointment</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="text-center md:text-center">
                <p class="text-lg text-gray-700 max-w-2xl mx-auto mb-4">
                    At WoofWagon, we pride ourselves on offering the best veterinary care for your pets. Whether it's routine check-ups or specialized treatments,
                    our expert team ensures that your furry friends stay happy and healthy.
                </p>
            </div>
<div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto bg-white p-8 shadow-lg rounded-lg text-center">
            <p class="text-gray-700 font-semibold mb-4">To book your pet's vet appointment, please contact us:</p>
            <p class="text-gray-900 font-bold mb-2">Phone: <span class="text-black ">123-456-7890</span></p>
            <p class="text-gray-900 font-bold">Email: <a href="mailto:bookings@WoofWagon.com" class="text-yellow-600 hover:underline">bookings@WoofWagon.com</a></p>
        </div>
    </div>
</section>

<!--grooming-->
<section class="py-10">
    <div class="container mx-auto px-4">
    <h1 class="text-3xl font-extrabold mb-6 text-center italic">Book a Grooming Appointment</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="container mx-auto px-4 text-center">
    <p class="text-lg text-gray-700 max-w-2xl mx-auto mb-4">
    WoofWagon offers exceptional grooming services that go beyond the basics.
     From luxurious baths and haircuts to nail trimming and ear cleaning, our team ensures your dog feels pampered and looks their best!</p>
</div>
<div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto bg-white p-8 shadow-lg rounded-lg text-center">
            <p class="text-gray-700 font-semibold mb-4">To book your pet's grooming appointment, please contact us:</p>
            <p class="text-gray-900 font-bold mb-2">Phone: <span class="text-black">123-456-7890</span></p>
            <p class="text-gray-900 font-bold">Email: <a href="mailto:bookings@WoofWagon.com" class="text-yellow-600 hover:underline">bookings@WoofWagon.com</a></p>
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

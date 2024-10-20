<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SomSurvey - Online Survey Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #FF79A3, #6E2EA1); /* Gradient transitioning from pink to purple */
            color: white;
        }
        .hero-content {
            height: 100vh; /* Full viewport height */
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .hero-text {
            max-width: 600px;
            padding: 20px; /* Added padding for better text spacing */
        }
        .hero-image {
            max-width: 50%; /* Makes image take 50% of width */
        }
        img {
            border-radius: 20px; /* Optional: Add border radius for the image */
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navigation Bar -->
    <header class="bg-transparent absolute top-0 left-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <a href="/" class="text-2xl font-bold text-white">SomSurvey</a>
                </div>
                @if (Route::has('login'))
                <nav class="hidden md:flex space-x-10 py-2">
                    <a href="#" class="text-white hover:text-yellow-400">About</a>
                    <a href="#" class="text-white hover:text-yellow-400">Services</a>
                    <a href="#" class="text-white hover:text-yellow-400">Contact</a>
                    <a href="#" class="text-white hover:text-yellow-400">Community</a>
                    @auth
                    <a href="/login" class="text-white hover:text-yellow-400">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-400">Login</a>
                    <a href="{{ route('register') }}" class="ml-4 px-4 bg-yellow-500 text-white rounded hover:bg-yellow-600">Sign Up</a>
                    @endif
                </nav>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 hero-content">
            <!-- Left: Text Section -->
            <div class="hero-text">
                <h1 class="text-5xl font-bold uppercase mb-6">Som <span class="text-yellow-400">Survey</span></h1>
                <p class="text-lg mb-8">Join us today and unlock the full potential of online surveys. With easy-to-use tools and instant results, you can gather actionable feedback and drive better decision-making for your business or research.</p>
                <a href="#" class="px-8 py-3 bg-yellow-500 text-white rounded hover:bg-yellow-600">Get Started Now</a>
            </div>

            <!-- Right: Illustration -->
            <div class="hero-image">
                <img src="{{ asset('images/4.png') }}" alt="Online Survey Illustration" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Call to Action Section (Optional) -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900">Why Choose SomSurvey</h2>
            <p class="mt-4 text-lg text-gray-600">Our platform makes it easy to create, distribute, and analyze surveys with real-time feedback, helping you gather valuable insights from your audience effortlessly.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between">
            <p>&copy; 2024 SomSurvey. All Rights Reserved.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-gray-400">Privacy Policy</a>
                <a href="#" class="hover:text-gray-400">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

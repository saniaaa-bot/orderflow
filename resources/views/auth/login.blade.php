<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - GlamBoutique</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'], serif: ['"Playfair Display"', 'serif'] }, colors: { glam: { pink: '#F9A8D4', beige: '#FDFBF7', olive: '#7A8B5A', dark: '#333333', blush: '#FBCFE8' } } } }
        }
    </script>
    <style>
        .bg-pattern {
            background-color: #FDFBF7;
            background-image: radial-gradient(#F9A8D4 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.1;
        }
    </style>
</head>
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark flex items-center justify-center p-4 relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern z-0 pointer-events-none"></div>

    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-xl border border-glam-blush/30 relative z-10">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-serif font-bold text-glam-dark mb-2">Welcome Back</h2>
            <p class="text-gray-500 text-sm">Log in to continue to GlamBoutique.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-glam-pink">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-glam-pink">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-glam-pink shadow-sm focus:ring-glam-pink" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-glam-pink font-medium hover:underline" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full bg-glam-dark text-white font-semibold py-3.5 rounded-xl hover:bg-glam-olive transition-all duration-300 shadow-md mt-6">
                Log In
            </button>

            <p class="text-center text-sm text-gray-500 mt-4">
                Don't have an account? <a href="{{ route('register') }}" class="text-glam-pink font-bold hover:underline">Sign up</a>
            </p>
        </form>
    </div>
</body>
</html>
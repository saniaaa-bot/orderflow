<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GlamBoutique</title>
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
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark flex items-start justify-center p-4 py-12 relative overflow-y-auto">
    <div class="absolute inset-0 bg-pattern z-0 pointer-events-none fixed"></div>

    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-xl border border-glam-blush/30 relative z-10 my-8">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-serif font-bold text-glam-dark mb-2">Create Account</h2>
            <p class="text-gray-500 text-sm">Join GlamBoutique to start shopping.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-glam-pink">
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-glam-pink">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Register As</label>
                <div class="relative">
                    <select id="role" name="role" class="w-full appearance-none bg-gray-50 border border-gray-200 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-glam-pink text-gray-700 font-medium cursor-pointer transition-all">
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-glam-olive">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-glam-pink">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full bg-gray-50 border border-gray-200 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-glam-pink">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500" />
            </div>

            <button type="submit" class="w-full bg-glam-dark text-white font-semibold py-3.5 rounded-xl hover:bg-glam-olive transition-all duration-300 shadow-md mt-6">
                Sign Up
            </button>

            <p class="text-center text-sm text-gray-500 mt-4">
                Already have an account? <a href="{{ route('login') }}" class="text-glam-pink font-bold hover:underline">Log in</a>
            </p>
        </form>
    </div>
</body>
</html>
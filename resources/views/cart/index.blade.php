<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Bag - GlamBoutique</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'], serif: ['"Playfair Display"', 'serif'] }, colors: { glam: { pink: '#F9A8D4', beige: '#FDFBF7', olive: '#7A8B5A', dark: '#333333', blush: '#FBCFE8' } } } }
        }
    </script>
</head>
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark flex flex-col">

    <nav class="w-full py-4 md:py-6 px-4 md:px-12 flex justify-between items-center border-b border-glam-blush bg-white/80 backdrop-blur-md">
        <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-serif font-bold text-glam-olive tracking-widest uppercase">
            GlamBoutique
        </a>
        <div class="flex items-center gap-4 md:gap-8">
            <a href="{{ route('home') }}" class="text-xs md:text-sm font-medium text-glam-dark hover:text-glam-pink transition-colors flex items-center gap-1 md:gap-2 uppercase tracking-wider">
                &larr; <span class="hidden sm:inline">Continue Shopping</span>
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 md:px-6 py-12 md:py-16 w-full flex-grow">
        <h1 class="text-3xl md:text-4xl font-serif font-bold text-glam-dark mb-8 text-center">Your Shopping Bag</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-center font-medium">{{ session('success') }}</div>
        @endif

        @if(count($cart) > 0)
            <div class="bg-white rounded-3xl shadow-sm border border-glam-blush/30 overflow-hidden mb-8">
                <div class="p-4 md:p-8">
                    @php $total = 0 @endphp
                    @foreach($cart as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <div class="flex items-center justify-between py-4 border-b border-glam-blush/30 last:border-0">
                            <div class="flex items-center gap-3 md:gap-4">
                                <img src="{{ $details['image_url'] ?? 'https://via.placeholder.com/100' }}" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-xl" alt="img">
                                <div>
                                    <h3 class="text-lg md:text-xl font-serif font-bold">{{ $details['name'] }}</h3>
                                    <p class="text-gray-500 text-xs md:text-sm">Qty: {{ $details['quantity'] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-base md:text-lg font-semibold text-glam-olive">${{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-red-400 text-xs md:text-sm hover:text-red-600 font-medium">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bg-glam-blush/10 p-4 md:p-8 border-t border-glam-blush/30 flex justify-end">
                    <div class="text-xl md:text-2xl font-serif">
                        Total: <span class="font-bold text-glam-olive">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-glam-blush/30 p-6 md:p-8">
                <h2 class="text-xl md:text-2xl font-serif font-bold mb-6">Checkout Details</h2>
                <form action="{{ route('checkout') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="customer_name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-glam-pink">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="customer_email" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-glam-pink">
                        </div>
                    </div>
                    <button type="submit" class="w-full mt-4 bg-glam-dark text-white font-semibold py-3 md:py-4 rounded-xl hover:bg-glam-olive transition-all duration-300 shadow-md">
                        Place Order (Mock Checkout)
                    </button>
                </form>
            </div>
        @else
            <div class="text-center py-16 md:py-20 bg-white rounded-3xl border border-glam-blush/30">
                <svg class="w-16 h-16 md:w-20 md:h-20 mx-auto text-glam-blush mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <h2 class="text-2xl font-serif text-glam-dark mb-2">Your bag is empty</h2>
                <a href="{{ route('home') }}" class="inline-block bg-glam-pink text-white font-semibold py-3 px-8 rounded-full hover:bg-glam-olive transition-colors mt-4">Start Shopping</a>
            </div>
        @endif
    </main>

</body>
</html>
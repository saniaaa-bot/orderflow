<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - GlamBoutique</title>
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
        <div class="flex items-center gap-4 md:gap-6">
            <a href="{{ route('home') }}" class="text-xs md:text-sm font-medium text-glam-dark hover:text-glam-pink transition-colors uppercase tracking-wider">Store</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs md:text-sm font-medium text-red-400 hover:text-red-600 transition-colors uppercase tracking-wider">Log Out</button>
            </form>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 md:px-6 py-12 w-full flex-grow">
        <h1 class="text-3xl md:text-4xl font-serif font-bold text-glam-dark mb-8">Welcome, {{ auth()->user()->name }}</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm font-medium">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm font-medium">{{ session('error') }}</div>
        @endif

        <h2 class="text-2xl font-serif font-bold mb-4">Your Orders</h2>
        
        <div class="space-y-4">
            @forelse($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-glam-blush/30 p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Order #{{ $order->id }} • {{ $order->created_at->format('M d, Y') }}</p>
                        <p class="text-lg font-serif font-bold text-glam-dark mb-2">Total: ${{ number_format($order->total_amount, 2) }}</p>
                        <p class="text-sm"><span class="font-bold">Items:</span> {{ $order->items->count() }}</p>
                    </div>
                    
                    <div class="flex flex-col items-end gap-3">
                        @if($order->status == 'Pending')
                            <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif($order->status == 'Confirmed')
                            <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Confirmed</span>
                        @elseif($order->status == 'Fulfilled')
                            <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Fulfilled</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Cancelled</span>
                        @endif

                        @if($order->status === 'Pending')
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium underline">Cancel Order</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl border border-glam-blush/30">
                    <p class="text-gray-500 font-serif text-lg">You haven't placed any orders yet.</p>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>
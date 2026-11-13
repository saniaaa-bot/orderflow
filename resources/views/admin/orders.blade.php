<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GlamBoutique</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        glam: {
                            pink: '#F9A8D4',
                            beige: '#FDFBF7',
                            olive: '#7A8B5A',
                            dark: '#333333',
                            blush: '#FBCFE8'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark flex">

    <aside class="w-64 bg-white border-r border-glam-blush/50 hidden md:flex flex-col shadow-sm">
        <div class="p-8 border-b border-glam-blush/30">
            <h1 class="text-2xl font-serif font-bold text-glam-olive tracking-widest uppercase">
                Glam<span class="text-glam-pink">Admin</span>
            </h1>
        </div>
        <nav class="flex-grow py-6">
            <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-8 py-4 bg-glam-blush/20 border-r-4 border-glam-pink text-glam-dark font-semibold transition-colors">
                <svg class="w-5 h-5 text-glam-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Orders
            </a>
            
            <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-8 py-4 text-gray-500 hover:bg-gray-50 hover:text-glam-dark transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Products
            </a>

            <a href="{{ route('home') }}" class="flex items-center gap-3 px-8 py-4 text-gray-500 hover:bg-gray-50 hover:text-glam-dark transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Back to Store
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-8 py-4 text-red-400 hover:bg-red-50 transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Log Out
                </button>
            </form>
        </nav>
    </aside>

    <div class="flex-grow flex flex-col min-h-screen overflow-hidden">
        
        <header class="bg-white/80 backdrop-blur-md border-b border-glam-blush/50 px-8 py-5 flex justify-between items-center shadow-sm z-10">
            <div class="flex items-center gap-4">
                <h2 class="text-2xl font-serif font-bold text-glam-dark">Order Management</h2>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm font-medium text-glam-olive hover:text-glam-pink transition-colors flex items-center gap-2 md:hidden">
                    Store
                </a>
                <span class="text-sm font-medium text-gray-500 hidden sm:inline">Welcome, Admin</span>
                <div class="w-10 h-10 rounded-full bg-glam-pink/20 flex items-center justify-center text-glam-pink font-bold shadow-inner">A</div>
            </div>
        </header>

        <main class="p-8 flex-grow overflow-y-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-glam-blush/30 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Orders</p>
                        <h3 class="text-3xl font-serif font-bold text-glam-dark">{{ $orders->count() }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-glam-blush/20 flex items-center justify-center text-glam-pink">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm font-medium">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-glam-blush/30 overflow-hidden">
                
                <div class="hidden md:grid grid-cols-12 gap-4 bg-glam-blush/10 px-6 py-4 border-b border-glam-blush/30 text-xs font-bold text-gray-500 uppercase tracking-wider">
                    <div class="col-span-2">Order ID</div>
                    <div class="col-span-4">Customer</div>
                    <div class="col-span-2">Total</div>
                    <div class="col-span-2">Status</div>
                    <div class="col-span-2 text-right">Update Status</div>
                </div>

                @forelse($orders as $order)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-5 border-b border-glam-blush/20 items-center hover:bg-glam-beige/50 transition-colors">
                        
                        <div class="col-span-2">
                            <span class="inline-block bg-glam-blush/30 text-glam-dark text-xs font-bold px-2 py-1 rounded">#{{ $order->id }}</span>
                            <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        
                        <div class="col-span-4">
                            <h4 class="font-serif font-bold text-glam-dark">{{ $order->customer_name }}</h4>
                            <p class="text-sm text-gray-500">{{ $order->customer_email }}</p>
                            <p class="text-xs text-glam-olive mt-1">{{ $order->items->count() }} Item(s) ordered</p>
                        </div>
                        
                        <div class="col-span-2">
                            <p class="text-lg font-bold text-glam-olive">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        
                        <div class="col-span-2">
                            @if($order->status == 'Pending')
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><span class="w-1.5 h-1.5 rounded-full bg-yellow-600"></span> Pending</span>
                            @elseif($order->status == 'Confirmed')
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Confirmed</span>
                            @elseif($order->status == 'Fulfilled')
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Fulfilled</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-red-100 text-red-800"><span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> Cancelled</span>
                            @endif
                        </div>
                        
                        <div class="col-span-2 text-left md:text-right mt-2 md:mt-0">
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                @csrf
                                <select name="status" class="block w-full appearance-none rounded-xl border border-glam-blush/50 bg-white py-2 pl-3 pr-8 text-xs font-medium text-glam-dark shadow-sm focus:border-glam-pink focus:outline-none focus:ring-1 focus:ring-glam-pink cursor-pointer hover:bg-gray-50 transition-colors" onchange="this.form.submit()">
                                    <option value="" disabled selected>Change Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Fulfilled">Fulfilled</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20">
                        <p class="text-gray-400 font-serif text-lg">No orders found.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - GlamAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'], serif: ['"Playfair Display"', 'serif'] }, colors: { glam: { pink: '#F9A8D4', beige: '#FDFBF7', olive: '#7A8B5A', dark: '#333333', blush: '#FBCFE8' } } } }
        }
    </script>
</head>
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark flex">

    <aside class="w-64 bg-white border-r border-glam-blush/50 hidden md:flex flex-col shadow-sm">
        <div class="p-8 border-b border-glam-blush/30">
            <h1 class="text-2xl font-serif font-bold text-glam-olive tracking-widest uppercase">Glam<span class="text-glam-pink">Admin</span></h1>
        </div>
        <nav class="flex-grow py-6">
            <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-8 py-4 text-gray-500 hover:bg-gray-50 hover:text-glam-dark transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Orders
            </a>
            <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-8 py-4 bg-glam-blush/20 border-r-4 border-glam-pink text-glam-dark font-semibold transition-colors">
                <svg class="w-5 h-5 text-glam-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
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

    <div class="flex-grow flex flex-col min-h-screen">
        <header class="bg-white/80 backdrop-blur-md border-b border-glam-blush/50 px-8 py-5 flex justify-between items-center shadow-sm">
            <h2 class="text-2xl font-serif font-bold text-glam-dark">Manage Products</h2>
            <a href="{{ route('admin.products.create') }}" class="bg-glam-dark text-white text-sm font-semibold py-2.5 px-6 rounded-xl hover:bg-glam-olive transition-colors shadow-md">
                + Add Product
            </a>
        </header>

        <main class="p-8 flex-grow">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm font-medium">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-glam-blush/30 overflow-hidden">
                <div class="hidden md:grid grid-cols-12 gap-4 bg-glam-blush/10 px-6 py-4 border-b border-glam-blush/30 text-xs font-bold text-gray-500 uppercase tracking-wider">
                    <div class="col-span-2">Image</div>
                    <div class="col-span-4">Product Name</div>
                    <div class="col-span-2">Price</div>
                    <div class="col-span-2">Stock</div>
                    <div class="col-span-2 text-right">Action</div>
                </div>

                @forelse($products as $product)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-5 border-b border-glam-blush/20 items-center hover:bg-glam-beige/50 transition-colors">
                        <div class="col-span-2">
                            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/50' }}" class="w-12 h-12 object-cover rounded-lg shadow-sm">
                        </div>
                        <div class="col-span-4">
                            <h4 class="font-serif font-bold text-glam-dark">{{ $product->name }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-1">{{ $product->description }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="font-bold text-glam-olive">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} py-1 px-2.5 rounded-full">{{ $product->stock }} in stock</span>
                        </div>
                        <div class="col-span-2 text-right">
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <p class="text-gray-500 font-serif">No products found. Add some!</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>
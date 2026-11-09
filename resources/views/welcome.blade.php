<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamBoutique - Girls Fashion Store</title>
    
    <!-- Elegant Fonts -->
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
    <style>
        .bg-pattern {
            background-color: #FDFBF7;
            background-image: radial-gradient(#F9A8D4 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.1;
        }
    </style>
</head>
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark flex flex-col relative overflow-x-hidden">

    <!-- Decorative Background -->
    <div class="absolute inset-0 bg-pattern z-0 pointer-events-none"></div>

    <!-- Navigation -->
    <nav class="relative z-10 w-full py-6 px-6 md:px-12 flex justify-between items-center border-b border-glam-blush">
        <h1 class="text-3xl font-serif font-bold text-glam-olive tracking-widest uppercase">
            GlamBoutique
        </h1>
        <div class="flex items-center gap-6">
            <button class="text-sm font-medium text-glam-dark hover:text-glam-pink transition-colors flex items-center gap-2 uppercase tracking-wider">
                Shopping Bag (0)
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative z-10 max-w-5xl mx-auto px-6 py-24 text-center">
        <svg class="w-12 h-12 mx-auto text-glam-pink mb-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/>
        </svg>
        
        <h2 class="text-5xl md:text-7xl font-serif font-bold text-glam-dark mb-6 leading-tight">
            Discover Your <br>
            <span class="italic text-glam-pink">Signature Style.</span>
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto font-light">
            Curated collections of premium dresses, bags, and accessories, delivered with elegance and love.
        </p>
    </header>

    <!-- Product Grid -->
    <main class="relative z-10 max-w-6xl mx-auto px-6 py-12 w-full flex-grow mb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($products as $product)
                <div class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-2xl transition-all duration-300 group border border-glam-blush/30 flex flex-col">
                    
                    <!-- Product Image Area -->
                    <div class="h-72 rounded-2xl relative overflow-hidden mb-6 bg-gray-100">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400x300?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="px-2 pb-2 flex flex-col flex-grow">
                        <h4 class="text-2xl font-serif font-bold text-glam-dark mb-2">{{ $product->name }}</h4>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2 font-light flex-grow">{{ $product->description }}</p>
                        
                        <div class="flex justify-between items-center pt-4 border-t border-glam-blush/50 mt-auto">
                            <span class="text-xl font-medium text-glam-olive">${{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('product.show', $product->id) }}" class="bg-glam-pink text-white text-sm font-semibold py-2.5 px-6 rounded-full hover:bg-glam-olive transition-colors duration-300">
                                View Item
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500 font-serif text-xl italic">
                    Our boutique is currently empty. Check back soon!
                </div>
            @endforelse
        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 bg-glam-dark text-glam-beige py-12 text-center mt-auto">
        <h2 class="text-3xl font-serif mb-4">GlamBoutique</h2>
        <p class="text-sm font-light opacity-70">© 2026 GlamBoutique. All rights reserved.</p>
    </footer>

</body>
</html>
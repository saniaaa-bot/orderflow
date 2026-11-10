<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - GlamBoutique</title>
    
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
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark flex flex-col">

    <nav class="w-full py-4 md:py-6 px-4 md:px-12 flex justify-between items-center border-b border-glam-blush bg-white/80 backdrop-blur-md">
        <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-serif font-bold text-glam-olive tracking-widest uppercase">
            GlamBoutique
        </a>
        <div class="flex items-center gap-4 md:gap-8">
            <a href="{{ route('cart.index') }}" class="text-xs md:text-sm font-medium text-glam-dark hover:text-glam-pink transition-colors flex items-center gap-1 md:gap-2 uppercase tracking-wider">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="hidden sm:inline">Shopping Bag</span> ({{ count(session()->get('cart', [])) }})
            </a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 md:px-6 py-8 md:py-12 w-full flex-grow">
        
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-glam-olive hover:text-glam-pink transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Store
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-4 rounded-xl mb-8 shadow-sm flex items-center justify-center gap-2 text-base md:text-lg font-medium" role="alert">
                <span>✨</span> <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl md:rounded-[3rem] shadow-xl border border-glam-blush/30 overflow-hidden flex flex-col md:flex-row relative">
            
            <div class="md:w-1/2 h-80 md:h-auto relative bg-gray-100 flex items-center justify-center">
                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/600x600?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center">
            </div>

            <div class="md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
                <span class="text-glam-olive font-semibold tracking-widest text-xs mb-3 uppercase border border-glam-olive w-max px-3 py-1 rounded-full">In Stock: {{ $product->stock }}</span>
                <h1 class="text-3xl md:text-5xl font-serif font-bold text-glam-dark mb-4 leading-tight">{{ $product->name }}</h1>
                <p class="text-gray-500 mb-8 leading-relaxed font-light">{{ $product->description }}</p>
                
                <div class="text-3xl font-serif text-glam-pink mb-8 md:mb-10">
                    ${{ number_format($product->price, 2) }}
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-glam-dark text-white font-semibold py-3 md:py-4 rounded-full hover:bg-glam-olive transition-all duration-300 shadow-md flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Add to Shopping Bag
                    </button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
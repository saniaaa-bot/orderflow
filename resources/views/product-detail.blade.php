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
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark">

    <!-- Navigation -->
    <nav class="w-full py-6 px-6 md:px-12 flex justify-between items-center border-b border-glam-blush">
        <a href="{{ route('home') }}" class="text-3xl font-serif font-bold text-glam-olive tracking-widest uppercase">
            GlamBoutique
        </a>
        <a href="{{ route('home') }}" class="text-sm font-medium text-glam-dark hover:text-glam-pink transition-colors flex items-center gap-2 uppercase tracking-wider">
            &larr; Back
        </a>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-16 w-full flex-grow">
        <div class="bg-white rounded-[3rem] shadow-xl border border-glam-blush/30 overflow-hidden flex flex-col md:flex-row relative">
            
            <!-- Image Area -->
            <div class="md:w-1/2 h-96 md:h-auto bg-glam-blush/40 relative flex items-center justify-center overflow-hidden">
                <!-- Abstract Shapes -->
                <div class="absolute w-64 h-64 bg-glam-pink rounded-full mix-blend-multiply filter blur-3xl opacity-50 top-10 left-10"></div>
                <div class="absolute w-48 h-48 bg-glam-olive rounded-full mix-blend-multiply filter blur-2xl opacity-30 bottom-10 right-10"></div>
                
                <svg class="w-40 h-40 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>

            <!-- Details Area -->
            <div class="md:w-1/2 p-10 md:p-16 flex flex-col justify-center">
                <span class="text-glam-olive font-semibold tracking-widest text-xs mb-3 uppercase">In Stock: {{ $product->stock }}</span>
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-glam-dark mb-4 leading-tight">{{ $product->name }}</h1>
                <p class="text-gray-500 mb-8 leading-relaxed font-light">{{ $product->description }}</p>
                
                <div class="text-3xl font-serif text-glam-pink mb-10">
                    ${{ number_format($product->price, 2) }}
                </div>

                <form action="#" method="POST">
                    @csrf
                    <button type="button" onclick="alert('Added to Bag!')" class="w-full bg-glam-dark text-white font-semibold py-4 rounded-full hover:bg-glam-olive transition-all duration-300 shadow-md">
                        Add to Shopping Bag
                    </button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
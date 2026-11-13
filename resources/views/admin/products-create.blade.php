<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - GlamAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'], serif: ['"Playfair Display"', 'serif'] }, colors: { glam: { pink: '#F9A8D4', beige: '#FDFBF7', olive: '#7A8B5A', dark: '#333333', blush: '#FBCFE8' } } } }
        }
    </script>
</head>
<body class="min-h-screen bg-glam-beige font-sans text-glam-dark p-8 flex items-center justify-center">
    <div class="w-full max-w-lg bg-white p-8 rounded-3xl shadow-xl border border-glam-blush/30">
        <a href="{{ route('admin.products') }}" class="text-sm font-semibold text-glam-olive hover:text-glam-pink mb-4 inline-block">&larr; Back to Products</a>
        <h2 class="text-3xl font-serif font-bold text-glam-dark mb-6 border-b border-glam-blush/30 pb-2">Add New Product</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-glam-pink">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-glam-pink"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                    <input type="number" step="0.01" name="price" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-glam-pink">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                    <input type="number" name="stock" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-glam-pink">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL (Optional)</label>
                <input type="url" name="image_url" placeholder="https://example.com/image.jpg" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-glam-pink">
            </div>
            <button type="submit" class="w-full bg-glam-dark text-white font-semibold py-3.5 rounded-xl hover:bg-glam-olive transition-all shadow-md mt-4">
                Save Product
            </button>
        </form>
    </div>
</body>
</html>
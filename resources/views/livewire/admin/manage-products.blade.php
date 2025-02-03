<div class="container mx-auto px-4 py-2 max-w-l">

    <!-- Heading -->
    <h1 class="text-3xl font-bold text-center mb-6">Manage Products</h1>

    <!-- Add Product Form -->
    <form wire:submit.prevent="addProduct" enctype="multipart/form-data" class="bg-white shadow-lg p-6 rounded-lg mb-8">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" wire:model="name" class="w-full border rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" id="price" wire:model="price" class="w-full border rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" id="stock" wire:model="stock" class="w-full border rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="image" wire:model="image" class="w-full border rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="w-1/3 bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-800">Add Product</button>
    </form>

    <!-- Product List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white shadow-lg rounded-md p-4 flex flex-col items-center">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-40 object-cover rounded-md mb-4">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-md mb-4">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
                <h2 class="text-lg font-bold mb-2">{{ $product->name }}</h2>
                <p class="text-sm text-gray-600">Price: ${{ $product->price }}</p>
                <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
                <div class="flex mt-4 space-x-2">
                    <button wire:click="deleteProduct({{ $product->id }})" 
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                    <!-- Edit Button -->
                    <button wire:click="editProduct({{ $product->id }})" 
                            class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Edit</button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal for Edit Product -->
    @if($id)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
            <h3 class="text-xl font-bold mb-4">Edit Product</h3>
            
            <form wire:submit.prevent="updateProduct">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" wire:model="name" class="w-full border rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" wire:model="price"  min="0" class="w-full border rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock" wire:model="stock" min="0" class="w-full border rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update</button>
                    <button type="button" wire:click="$set('id', null)" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

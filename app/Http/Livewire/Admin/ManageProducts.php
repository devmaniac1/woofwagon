<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageProducts extends Component
{
    use WithFileUploads;

    public $id, $name, $category, $price, $stock, $image;
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|max:2048',
        ]);

       // Move the image from temporary to the public/images directory
    $imageName = $this->image->store('images', 'public'); // Save under storage/app/public/images

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $imageName,
        ]);

        session()->flash('message', 'Product added successfully!');

        $this->reset(['name', 'price', 'stock', 'image']);
        $this->products = Product::all();
    }

    // Delete a product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        $this->products = Product::all(); // Refresh product list
    }

    // Edit a product
    public function editProduct($id)
    {
        $this->id = $id;
        
        // Fetch the product details from the database
        $product = Product::find($id);

        // Populate the form fields with the existing product details
        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock = $product->stock;
        
        // For now, we're just filling the variables to update the UI
    }

    // Update a product
    public function updateProduct()
    {
        $product = Product::find($this->id);

        // Validate the updated fields
        $this->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        ]);

        // Update the product in the database
        $product->update([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);
}
    public function render()
    {
        return view('livewire.admin.manage-products')
        ->layout('components.layouts.app');
    }
}

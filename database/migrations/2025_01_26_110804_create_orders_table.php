<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Customer's name
            $table->string('email'); // Customer's email
            $table->string('phone'); // Customer's phone number
            $table->text('address'); // Customer's delivery address
            $table->enum('payment_method', ['cash_on_delivery', 'card_on_delivery']); // Payment method
            $table->decimal('discount', 8, 2)->default(0); // Discount applied
            $table->decimal('total', 8, 2); // Grand total
            $table->json('products'); // Store products in JSON format
            $table->enum('status', ['Pending', 'Delivered', 'Cancelled'])->default('Pending'); // Order status
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

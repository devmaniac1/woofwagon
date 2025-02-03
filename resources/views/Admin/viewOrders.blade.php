<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto p-6">
            <!-- Table Container -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 bg-yellow-800 text-white text-center font-semibold">
                    <p class="text-xl">View and manage customer orders.</p>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 mt-4">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border border-gray-300 p-3 text-left">Order ID</th>
                                <th class="border border-gray-300 p-3 text-left">Customer</th>
                                <th class="border border-gray-300 p-3 text-left">Products</th>
                                <th class="border border-gray-300 p-3 text-left">Payment Method</th>
                                <th class="border border-gray-300 p-3 text-left">Total</th>
                                <th class="border border-gray-300 p-3 text-left">Date</th>
                                <th class="border border-gray-300 p-3 text-left">Status</th>
                                <th class="border border-gray-300 p-3 text-left">Contact Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="p-3 text-gray-800">{{ $order->id }}</td>
                                    <td class="p-3 text-gray-800">{{ $order->name }}</td>
                                    <td class="p-3 text-gray-800">
                                        @php
                                            $products = json_decode($order->products, true);
                                        @endphp
                                        @if(is_array($products) && !empty($products))
                                            @foreach($products as $product)
                                                <p class="text-sm text-gray-600">{{ $product['name'] ?? 'Unknown Product' }} (Qty: {{ $product['quantity'] ?? 0 }})</p>
                                            @endforeach
                                        @else
                                            <p class="text-sm text-gray-600">No products found</p>
                                        @endif
                                    </td>
                                    <td class="p-3 text-gray-800">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                    <td class="p-3 text-gray-800">LKR {{ number_format($order->total, 2) }}</td>
                                    <td class="p-3 text-gray-800">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="p-3">
                                        <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="p-2 border rounded-md bg-blue-50 hover:bg-blue-100 transition-colors" onchange="this.form.submit()">
                                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <!-- Add a submit button (just in case) -->
    <button type="submit" style="display: none;">Submit</button>
                                        </form>
                                    </td>
                                    <td class="p-3 text-gray-800">
                                        <p>Email: <span class="font-semibold">{{ $order->email }}</span></p>
                                        <p>Phone: <span class="font-semibold">{{ $order->phone }}</span></p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

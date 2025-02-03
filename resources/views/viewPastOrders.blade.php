<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">My Past Orders</h2>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-6">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-yellow-800 text-white">
                    <tr>
                        <th class="border px-4 py-3 text-left">Order ID</th>
                        <th class="border px-4 py-3 text-left">Order Date</th>
                        <th class="border px-4 py-3 text-left">Total (LKR)</th>
                        <th class="border px-4 py-3 text-left">Payment Method</th>
                        <th class="border px-4 py-3 text-left">Status</th>
                        <th class="border px-4 py-3 text-left">Products</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-3">{{ $order->id }}</td>
                            <td class="border px-4 py-3">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="border px-4 py-3 font-semibold text-green-600">{{ number_format($order->total, 2) }}</td>
                            <td class="border px-4 py-3 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</td>
                            <td class="border px-4 py-3">
                                <span class="px-3 py-1 rounded-lg text-white
                                    @if($order->status == 'Pending') bg-yellow-500
                                    @elseif($order->status == 'Cancelled') bg-red-500
                                    @else bg-green-500 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="border px-4 py-3">
                                @php
                                    $products = json_decode($order->products, true);
                                @endphp
                                @if($products)
                                    <ul class="list-disc pl-5">
                                        @foreach($products as $product)
                                            <li>{{ $product['name'] }} x{{ $product['quantity'] }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($orders->isEmpty())
                <p class="text-center mt-4 text-gray-600">You have no past orders.</p>
            @endif
        </div>
    </div>
</x-app-layout>

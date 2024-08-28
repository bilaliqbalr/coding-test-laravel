<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Listing</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-6">
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Customer Orders Listing</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('customers.index') }}" class="mb-4 flex space-x-4">
        <input type="text" name="email" placeholder="Search by Email" value="{{ request('email') }}"
               class="p-2 border border-gray-300 rounded w-full">
        <input type="text" name="order_number" placeholder="Search by Order Number" value="{{ request('order_number') }}"
               class="p-2 border border-gray-300 rounded w-full">
        <input type="text" name="item_name" placeholder="Search by Item Name" value="{{ request('item_name') }}"
               class="p-2 border border-gray-300 rounded w-full">
        <button type="submit" class="p-2 bg-blue-500 text-white rounded">Search</button>
    </form>

    <!-- Customer Listing -->
    <div class="space-y-4">
        @foreach ($customers as $customer)
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold">{{ $customer->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $customer->email }}</p>
                </div>

                <!-- Orders and Items -->
                <div class="space-y-4">
                    @foreach ($customer->orders as $order)
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="text-gray-700 font-semibold">Order #: {{ $order->order_number }}</div>
                            <div class="mt-2">
                                <span class="font-semibold text-gray-600">Items:</span>
                                <ul class="list-disc list-inside grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->name }} ({{ $item->price }}$)</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $customers->withQueryString()->links() }}
    </div>
</div>
</body>
</html>

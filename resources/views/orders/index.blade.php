<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinelytics - Orders</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    All Orders
                </h2>
            </div>
        </header>

        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Filter and Sort Form (Unchanged) -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-medium mb-4">Filter & Sort Orders</h3>
                            <form method="GET" action="{{ route('orders.index') }}" id="filters-form" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="sort" class="block text-sm font-medium text-gray-700">Sort By</label>
                                        <select name="sort" id="sort" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="created_at" @selected(request('sort', 'created_at') == 'created_at')>Order Date</option>
                                            <option value="id" @selected(request('sort') == 'id')>Order ID</option>
                                            <option value="total_amount" @selected(request('sort') == 'total_amount')>Total Amount</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="direction" class="block text-sm font-medium text-gray-700">Direction</label>
                                        <select name="direction" id="direction" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="desc" @selected(request('direction', 'desc') == 'desc')>Descending</option>
                                            <option value="asc" @selected(request('direction') == 'asc')>Ascending</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{-- This div will allow the table to scroll horizontally on small screens --}}
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dish Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->dish->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->quantity }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($order->total_amount, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No orders found matching your criteria.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $orders->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const filtersForm = document.getElementById('filters-form');
        const inputs = filtersForm.querySelectorAll('input, select');

        inputs.forEach(input => {
            input.addEventListener('change', () => {
                filtersForm.submit();
            });
        });
    </script>
</body>
</html>

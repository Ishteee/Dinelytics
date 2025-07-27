<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dinelytics Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts (Vite handles compiling our CSS and JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dinelytics Dashboard
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">

                            <!-- Main Stats Cards (Unchanged) -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow">
                                    <div class="text-sm font-medium uppercase text-gray-500">Total Revenue</div>
                                    <div class="text-3xl font-bold">${{ number_format($totalRevenue, 2) }}</div>
                                </div>
                                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow">
                                    <div class="text-sm font-medium uppercase text-gray-500">Total Orders</div>
                                    <div class="text-3xl font-bold">{{ $totalOrders }}</div>
                                </div>
                                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow">
                                    <div class="text-sm font-medium uppercase text-gray-500">Avg. Order Value</div>
                                    <div class="text-3xl font-bold">
                                        ${{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 2) : '0.00' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Charts and Top Dishes -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Chart Section -->
                                <div class="lg:col-span-2 bg-gray-50 p-6 rounded-lg shadow">
                                    <h3 class="font-semibold mb-4">Revenue Over Last 30 Days</h3>
                                    {{-- **MODIFIED CONTAINER** This div now has a defined height and relative position --}}
                                    <div class="relative h-64 md:h-96">
                                        <canvas id="revenueChart"
                                            data-labels="{{ $chartLabels->toJson() }}"
                                            data-data="{{ $chartData->toJson() }}"
                                        ></canvas>
                                    </div>
                                </div>

                                <!-- Top 5 Dishes Table (Unchanged) -->
                                <div class="bg-gray-50 p-6 rounded-lg shadow">
                                    <h3 class="font-semibold mb-4">Most Ordered Dishes</h3>
                                    <ul class="space-y-2">
                                        @forelse ($mostOrderedDishes as $item)
                                            <li class="flex justify-between items-center p-2 bg-white rounded shadow-sm">
                                                <span class="font-medium text-gray-700">{{ $item->dish->name }}</span>
                                                <span class="font-bold text-gray-900 bg-gray-200 px-2 py-1 rounded-full text-sm">{{ $item->total_quantity }}</span>
                                            </li>
                                        @empty
                                            <li>No orders found.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const revenueChartEl = document.getElementById('revenueChart');
        const labels = JSON.parse(revenueChartEl.dataset.labels);
        const data = JSON.parse(revenueChartEl.dataset.data);

        new Chart(revenueChartEl, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Daily Revenue ($)',
                    data: data,
                    fill: true,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // <-- This is the key change
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>
</html>

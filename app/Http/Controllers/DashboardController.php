<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- Make sure Request is imported
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index()
    {
        // ... (this method is unchanged)
        $totalRevenue = Order::sum('total_amount');
        $totalOrders = Order::count();
        $mostOrderedDishes = Order::query()
            ->select('dish_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('dish_id')
            ->orderBy('total_quantity', 'desc')
            ->with('dish')
            ->limit(5)
            ->get();
        $revenueByDay = Order::query()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $chartLabels = $revenueByDay->pluck('date');
        $chartData = $revenueByDay->pluck('total');

        return view('dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'mostOrderedDishes' => $mostOrderedDishes,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
        ]);
    }

    /**
     * Show the page with all dishes.
     */
    public function dishesIndex()
    {
        // ... (this method is unchanged)
        $dishes = Dish::orderBy('name')->get();
        return view('dishes.index', ['dishes' => $dishes]);
    }

    /**
     * Show the page with all orders, now with filtering and sorting.
     */
    public function ordersIndex(Request $request)
    {
        // Validate the request parameters for sorting
        $sortableColumns = ['id', 'total_amount', 'created_at'];
        $sort = in_array($request->query('sort'), $sortableColumns) ? $request->query('sort') : 'created_at';
        $direction = $request->query('direction') === 'asc' ? 'asc' : 'desc';

        // Start the query
        $query = Order::with('dish');

        // Apply date filters if they exist
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Apply sorting and paginate the results (15 per page)
        $orders = $query->orderBy($sort, $direction)->paginate(15);

        // Pass all data, including the current sort/filter state, to the view
        return view('orders.index', [
            'orders' => $orders,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }
}

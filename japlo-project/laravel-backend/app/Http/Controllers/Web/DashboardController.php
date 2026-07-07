<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isDriver()) {
            return $this->driverDashboard();
        } else {
            return $this->customerDashboard();
        }
    }

    private function customerDashboard()
    {
        $user = Auth::user();
        
        // Get user statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $activeOrder = Order::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'accepted', 'picked_up', 'in_progress'])
            ->first();
        
        // Get recent orders
        $recentOrders = Order::where('user_id', $user->id)
            ->with(['driver'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalOrders',
            'completedOrders',
            'activeOrder',
            'recentOrders'
        ));
    }

    private function driverDashboard()
    {
        $user = Auth::user();
        $driver = $user->driver;

        // If driver profile not complete, redirect to complete profile
        if (!$driver) {
            return redirect()->route('driver.profile.create')
                ->with('info', 'Silakan lengkapi profil driver Anda terlebih dahulu.');
        }

        // Get driver statistics
        $totalRides = $driver->total_rides;
        $totalEarnings = $driver->total_earnings;
        $rating = $driver->rating;

        // Today's statistics
        $todayOrders = Order::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', today())
            ->count();

        $todayEarnings = Order::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', today())
            ->sum('price');

        // Recent orders
        $recentOrders = Order::where('driver_id', $user->id)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pending orders nearby (if driver is available)
        $pendingOrders = collect();
        if ($driver->is_available && $driver->current_latitude && $driver->current_longitude) {
            $pendingOrders = Order::selectRaw(
                'orders.*, ( 6371 * acos( cos( radians(?) ) * cos( radians( pickup_latitude ) ) * cos( radians( pickup_longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( pickup_latitude ) ) ) ) AS distance',
                [$driver->current_latitude, $driver->current_longitude, $driver->current_latitude]
            )
                ->with('user')
                ->where('status', 'pending')
                ->having('distance', '<=', 15)
                ->orderBy('distance', 'asc')
                ->limit(10)
                ->get();
        }

        return view('driver.dashboard', compact(
            'driver',
            'totalRides',
            'totalEarnings',
            'rating',
            'todayOrders',
            'todayEarnings',
            'recentOrders',
            'pendingOrders'
        ));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
}

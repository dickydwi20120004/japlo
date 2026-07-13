<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Rating;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistics
        $totalUsers = User::where('role', 'user')->count();
        $totalDrivers = User::where('role', 'driver')->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('price');
        
        // Recent orders
        $recentOrders = Order::with(['user', 'driver.user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Recent users
        $recentUsers = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Recent drivers
        $recentDrivers = User::where('role', 'driver')
            ->with('driver')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDrivers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'recentUsers',
            'recentDrivers'
        ));
    }
    
    public function users()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.users', compact('users'));
    }
    
    public function drivers()
    {
        $drivers = User::where('role', 'driver')
            ->with('driver')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.drivers', compact('drivers'));
    }
    
    public function orders()
    {
        $orders = Order::with(['user', 'driver.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.orders', compact('orders'));
    }
}

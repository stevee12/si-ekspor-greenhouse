<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
//use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $customersCount = Customer::count();
        $recentOrders = Order::latest()->take(2)->get();
        //        $customersCount = Customer::count();

        return view('dashboard', compact('productsCount', 'ordersCount', 'customersCount', 'recentOrders'));
    }
}

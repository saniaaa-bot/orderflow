<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.orders');
        }

        $orders = Order::where('customer_email', Auth::user()->email)->latest()->get();
        
        return view('dashboard', compact('orders'));
    }

    public function cancelOrder(Order $order)
    {
        if ($order->customer_email === Auth::user()->email && $order->status === 'Pending') {
            $order->update(['status' => 'Cancelled']);
            return redirect()->back()->with('success', 'Order cancelled successfully!');
        }

        return redirect()->back()->with('error', 'You cannot cancel this order.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'service')->orderByDesc('created_at')->limit(20)->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,under_review,paid,in_progress,completed'],
        ]);
        $order->status = $request->status;
        $order->save();

        if($order->payment && $request->status === 'paid'){
            $order->payment->status = 'received';
            $order->payment->save();
        }

        return back()->with('success', 'تم تحديث حالة الطلب');
    }
}

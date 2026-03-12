<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    /**
     * عرض جميع الطلبات
     */
    public function index()
    {
        $orders = Order::with('user', 'service')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.orders.all', compact('orders'));
    }

    /**
     * تحديث حالة الطلب
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,under_review,in_progress,completed,cancelled'],
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }
}

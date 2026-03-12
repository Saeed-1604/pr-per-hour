<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        // إحصائيات الطلبات حسب الحالة
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // أعلى العملاء بعدد الطلبات
        $topCustomers = Order::select('user_id', DB::raw('count(*) as order_count'))
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('order_count', 'desc')
            ->limit(10)
            ->get();

        // أعلى الخدمات المطلوبة
        $topServices = Order::select('service_id', DB::raw('count(*) as order_count'))
            ->with('service')
            ->groupBy('service_id')
            ->orderBy('order_count', 'desc')
            ->limit(10)
            ->get();

        // الإيرادات الإجمالية من الدفعات المكتملة
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');

        // متوسط قيمة الدفعة
        $averageOrderPrice = Payment::where('status', 'completed')->avg('amount');

        // عدد الطلبات هذا الشهر
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('admin.reports.index', [
            'ordersByStatus' => $ordersByStatus,
            'topCustomers' => $topCustomers,
            'topServices' => $topServices,
            'totalRevenue' => $totalRevenue,
            'averageOrderPrice' => $averageOrderPrice,
            'ordersThisMonth' => $ordersThisMonth
        ]);
    }
}

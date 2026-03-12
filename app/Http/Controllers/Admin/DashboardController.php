<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = \App\Models\Order::count();
        $newOrders = \App\Models\Order::where('status', 'pending')->count();
        $customers = \App\Models\User::where('email', '!=', 'f.maali@prperhour.com')->count();
        $activeChats = \App\Models\Chat::count();
        $unreadMessages = Message::where('status', 'unread')->count();

        $latestOrders = \App\Models\Order::with('user', 'service')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $latestChats = \App\Models\Chat::with('user', 'order')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $latestMessages = Message::orderByDesc('created_at')
            ->limit(8)
            ->get();

        // التاريخ والوقت الحالي
        $now = now();
        $arabicDate = $this->getArabicDateTime($now);

        return view('admin.dashboard', compact(
            'totalOrders',
            'newOrders',
            'customers',
            'activeChats',
            'unreadMessages',
            'latestOrders',
            'latestChats',
            'latestMessages',
            'arabicDate',
            'now'
        ));
    }

    /**
     * تحويل التاريخ والوقت إلى صيغة عربية
     */
    private function getArabicDateTime($date)
    {
        $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
        $months = [
            'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
            'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
        ];

        $dayName = $days[$date->dayOfWeek];
        $monthName = $months[$date->month - 1];
        $day = $date->day;
        $year = $date->year;
        $hour = str_pad($date->hour, 2, '0', STR_PAD_LEFT);
        $minute = str_pad($date->minute, 2, '0', STR_PAD_LEFT);

        return "{$dayName}, {$day} {$monthName} {$year} - {$hour}:{$minute}";
    }
}

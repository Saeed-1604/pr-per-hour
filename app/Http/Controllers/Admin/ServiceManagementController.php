<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceManagementController extends Controller
{
    public function index()
    {
        // جلب جميع الخدمات مع عدد الطلبات لكل خدمة
        $services = Service::withCount('orders')
            ->paginate(20);

        return view('admin.services.all', [
            'services' => $services
        ]);
    }
}

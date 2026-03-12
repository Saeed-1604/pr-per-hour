<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerManagementController extends Controller
{
    public function index()
    {
        // جلب جميع العملاء (غير الإداريين)
        $customers = User::where('is_admin', false)
            ->withCount(['orders', 'chats'])
            ->paginate(20);

        return view('admin.customers.all', [
            'customers' => $customers
        ]);
    }
}

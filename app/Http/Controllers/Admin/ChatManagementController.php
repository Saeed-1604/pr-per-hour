<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chat;
use App\Http\Controllers\Controller;

class ChatManagementController extends Controller
{
    /**
     * عرض جميع المحادثات
     */
    public function index()
    {
        $chats = Chat::with('user', 'order', 'order.service')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.chats.all', compact('chats'));
    }
}

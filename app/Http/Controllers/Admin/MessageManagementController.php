<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageManagementController extends Controller
{
    /**
     * عرض جميع الرسائل
     */
    public function index()
    {
        $messages = Message::orderByDesc('created_at')
            ->paginate(20);

        return view('admin.messages.all', compact('messages'));
    }

    /**
     * تغيير حالة الرسالة إلى مقروءة
     */
    public function markAsRead(Message $message)
    {
        $message->update(['status' => 'read']);

        return back()->with('success', 'تم وضع علامة "مقروء" على الرسالة');
    }

    /**
     * تغيير حالة الرسالة إلى لم تُقرأ
     */
    public function markAsUnread(Message $message)
    {
        $message->update(['status' => 'unread']);

        return back()->with('success', 'تم وضع علامة "لم تُقرأ" على الرسالة');
    }

    /**
     * حذف الرسالة
     */
    public function delete(Message $message)
    {
        $message->delete();

        return back()->with('success', 'تم حذف الرسالة');
    }
}

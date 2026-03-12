<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show(Order $order)
    {
        // only owner or admin
        if (Auth::id() !== $order->user_id && Auth::user()->email !== 'f.maali@prperhour.com') {
            abort(403);
        }

        $chats = $order->chats()->with('user')->orderBy('created_at')->get();
        return view('orders.chat', compact('order', 'chats'));
    }

    public function store(Request $request, Order $order)
    {
        if (Auth::id() !== $order->user_id && Auth::user()->email !== 'f.maali@prperhour.com') {
            abort(403);
        }

        $request->validate([
            'message' => ['required', 'string'],
        ]);

        Chat::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back();
    }
}

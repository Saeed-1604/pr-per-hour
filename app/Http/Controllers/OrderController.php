<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Upload;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'details' => ['nullable', 'string'],
            'problem_type' => ['nullable', 'string'],
            'other_problem' => ['nullable', 'string'],
            'page_link1' => ['nullable', 'url'],
            'page_link2' => ['nullable', 'url'],
            'payment_method' => ['required', 'in:bank,reflect'],
            'payment_phone' => ['nullable', 'string'],
            'payment_proof' => ['nullable', 'file', 'mimes:jpg,png,pdf'],
            'extra_files.*' => ['nullable', 'file', 'mimes:jpg,png,pdf,doc,docx'],
            'agree' => ['accepted'],
            // additional fields are collected in meta
        ]);

        $service = Service::findOrFail($data['service_id']);

        $order = Order::create([
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'status' => 'pending',
            'details' => $data['details'] ?? null,
            'meta' => $request->except(["_token","service_id","details","payment_method","payment_phone","payment_proof"]),
        ]);

        // handle payment record
        $payment = new Payment([
            'method' => $data['payment_method'],
            'phone' => $data['payment_phone'] ?? null,
            'status' => 'pending',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payments', 'public');
            $payment->proof_path = $path;

            // also create upload record
            Upload::create([
                'order_id' => $order->id,
                'type' => 'payment_proof',
                'path' => $path,
            ]);
        }

        $order->payment()->save($payment);

        // save any extra uploaded files
        if ($request->hasFile('extra_files')) {
            foreach ($request->file('extra_files') as $file) {
                $path = $file->store('extras', 'public');
                Upload::create([
                    'order_id' => $order->id,
                    'type' => 'extra',
                    'path' => $path,
                ]);
            }
        }

        // redirect to confirmation page with phone numbers
        return redirect()->route('orders.confirmation', $order)->with('success', 'تم إرسال الطلب بنجاح');
    }

    public function confirmation(Order $order)
    {
        // ensure the user owns the order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // payment phone numbers to show
        $phones = [
            'bank' => '059-1234567',
            'reflect' => '059-7654321',
        ];

        return view('orders.confirmation', compact('order', 'phones'));
    }

    public function myOrders()
    {
        $orders = Order::with('service')->where('user_id', Auth::id())->orderByDesc('created_at')->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // user can view their own order
        if ($order->user_id !== Auth::id() && Auth::user()->email !== 'f.maali@prperhour.com') {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}

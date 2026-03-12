<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Upload;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // Step 1: Display payment form with order details
    public function paymentForm(Order $order)
    {
        if ($order->user_id !== Auth::id() && Auth::user()->email !== 'f.maali@prperhour.com') {
            abort(403);
        }

        return view('payment.form', compact('order'));
    }

    // Step 2: Process payment (simulate deduction) and show upload form
    public function processPayment(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'in:bank,reflect'],
            'payment_phone' => ['required', 'string'],
        ]);

        // Create payment record
        $payment = Payment::create([
            'order_id' => $order->id,
            'method' => $validated['payment_method'],
            'phone' => $validated['payment_phone'],
            'status' => 'pending',
        ]);

        // Move to upload proof step
        return view('payment.upload-proof', compact('order', 'payment'));
    }

    // Step 3: Upload payment proof
    public function uploadProof(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf'],
        ]);

        $payment = $order->payment;

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payments', 'public');
            $payment->proof_path = $path;
            $payment->status = 'received';
            $payment->save();

            Upload::create([
                'order_id' => $order->id,
                'type' => 'payment_proof',
                'path' => $path,
            ]);
        }

        // Update order status
        $order->status = 'under_review';
        $order->save();

        return view('payment.success', compact('order'));
    }
}

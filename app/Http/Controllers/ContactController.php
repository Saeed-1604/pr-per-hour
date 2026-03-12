<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // حفظ الرسالة في قاعدة البيانات
        Message::create($validated);
        
        return redirect()->route('contact')->with('success', true);
    }
}

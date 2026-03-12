<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.settings', ['user' => $user]);
    }

    public function updateEmail(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'email_confirmation' => 'required|same:email',
        ], [
            'current_password.required' => 'كلمة المرور الحالية مطلوبة',
            'current_password.current_password' => 'كلمة المرور الحالية غير صحيحة',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صحيح الصيغة',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل',
            'email_confirmation.required' => 'تأكيد البريد الإلكتروني مطلوب',
            'email_confirmation.same' => 'البريد الإلكتروني وتأكيده غير متطابقة',
        ]);

        $user->update(['email' => $validated['email']]);

        return redirect()->route('admin.settings')
            ->with('success', 'تم تحديث البريد الإلكتروني بنجاح');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ], [
            'current_password.required' => 'كلمة المرور الحالية مطلوبة',
            'current_password.current_password' => 'كلمة المرور الحالية غير صحيحة',
            'password.required' => 'كلمة المرور الجديدة مطلوبة',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل',
            'password.mixed_case' => 'يجب أن تحتوي كلمة المرور على أحرف كبيرة وصغيرة',
            'password.numbers' => 'يجب أن تحتوي كلمة المرور على أرقام',
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('admin.settings')
            ->with('success', 'تم تحديث كلمة المرور بنجاح');
    }
}

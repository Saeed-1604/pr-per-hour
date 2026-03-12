<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق من أن المستخدم مسجل الدخول وأنه إداري
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // إذا لم يكن إداري، نرجعه للصفحة الرئيسية مع رسالة خطأ
        return redirect('/')->with('error', 'غير مصرح لك بالدخول إلى هذه الصفحة');
    }
}

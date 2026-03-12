<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;

// الصفحة الرئيسية
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('services');
    }
    return view('welcome');
})->name('home');

// صفحات تسجيل الدخول والتسجيل (للضيوف فقط)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// تسجيل الخروج (للمسجلين فقط)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// صفحة الخدمات (للمسجلين فقط)
Route::get('/services', [\App\Http\Controllers\ServiceController::class, 'index'])
    ->name('services')->middleware('auth');

// عرض صفحة خدمة فردية
Route::get('/service/{slug}', [\App\Http\Controllers\ServiceController::class, 'show'])
    ->name('service.show')->middleware('auth');

// صفحات معلومات عامة
Route::get('/terms', function() { return view('terms'); })->name('terms');
Route::get('/about', function() { return view('about'); })->name('about');
Route::get('/faq', function() { return view('faq'); })->name('faq');
Route::get('/privacy', function() { return view('privacy'); })->name('privacy');
Route::get('/sitemap', function() { return view('sitemap'); })->name('sitemap');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'show'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// اختصارات الخدمات
Route::get('/consultation', function() { return redirect()->route('service.show','consultation'); });
Route::get('/starter-content-package', function() { return redirect()->route('service.show','starter-content-package'); });
Route::get('/content-package', function() { return redirect()->route('service.show','starter-content-package'); });
Route::get('/growth-content-strategy', function() { return redirect()->route('service.show','growth-content-strategy'); });
Route::get('/growth-strategy', function() { return redirect()->route('service.show','growth-content-strategy'); });
Route::get('/pr-core', function() { return redirect()->route('service.show','pr-core'); });
Route::get('/celebrity-builder', function() { return redirect()->route('service.show','celebrity-builder'); });
Route::get('/ad-account-rescue', function() { return redirect()->route('service.show','ad-account-rescue'); });
Route::get('/creative-advertising', function() { return redirect()->route('service.show','creative-advertising'); });

// طلب خدمة
Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])
    ->name('orders.store')->middleware('auth');

// دردشة مرتبطة بالطلب
Route::get('/orders/{order}/chat', [\App\Http\Controllers\ChatController::class, 'show'])
    ->name('orders.chat.show')->middleware('auth');
Route::post('/orders/{order}/chat', [\App\Http\Controllers\ChatController::class, 'store'])
    ->name('orders.chat.store')->middleware('auth');

Route::get('/orders/{order}/confirmation', [\App\Http\Controllers\OrderController::class, 'confirmation'])
    ->name('orders.confirmation')->middleware('auth');

Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])
    ->name('orders.show')->middleware('auth');

// نظام الدفع على مرحلتين
Route::get('/orders/{order}/payment', [\App\Http\Controllers\PaymentController::class, 'paymentForm'])
    ->name('payment.form')->middleware('auth');
Route::post('/orders/{order}/payment', [\App\Http\Controllers\PaymentController::class, 'processPayment'])
    ->name('payment.process')->middleware('auth');
Route::post('/orders/{order}/upload-proof', [\App\Http\Controllers\PaymentController::class, 'uploadProof'])
    ->name('payment.upload-proof')->middleware('auth');

// صفحة طلباتي
Route::get('/my-orders', [\App\Http\Controllers\OrderController::class, 'myOrders'])
    ->name('my-orders')
    ->middleware('auth');

// لوحة التحكم (للدكتورة فقط)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // إدارة الطلبات
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderManagementController::class, 'index'])->name('admin.orders');
    Route::post('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderManagementController::class, 'updateStatus'])->name('admin.orders.status');

    // إدارة العملاء
    Route::get('/customers', [\App\Http\Controllers\Admin\CustomerManagementController::class, 'index'])->name('admin.customers');

    // إدارة الخدمات
    Route::get('/services', [\App\Http\Controllers\Admin\ServiceManagementController::class, 'index'])->name('admin.services');

    // إدارة المحادثات
    Route::get('/chats', [\App\Http\Controllers\Admin\ChatManagementController::class, 'index'])->name('admin.chats');

    // إدارة الرسائل
    Route::get('/messages', [\App\Http\Controllers\Admin\MessageManagementController::class, 'index'])->name('admin.messages');
    Route::post('/messages/{message}/read', [\App\Http\Controllers\Admin\MessageManagementController::class, 'markAsRead'])->name('admin.messages.read');
    Route::post('/messages/{message}/unread', [\App\Http\Controllers\Admin\MessageManagementController::class, 'markAsUnread'])->name('admin.messages.unread');
    Route::post('/messages/{message}/delete', [\App\Http\Controllers\Admin\MessageManagementController::class, 'delete'])->name('admin.messages.delete');

    // التقارير
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('admin.reports');

    // الإعدادات
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings/email', [\App\Http\Controllers\Admin\SettingsController::class, 'updateEmail'])->name('admin.settings.email');
    Route::post('/settings/password', [\App\Http\Controllers\Admin\SettingsController::class, 'updatePassword'])->name('admin.settings.password');
});

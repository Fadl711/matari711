<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', [SectionController::class, 'welcome'])->name('home');

// عرض منشورات قسم معين
Route::get('/section/{id}', [SectionController::class, 'showSection'])->name('posts.section');

// عرض منشور معين
Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');

// البحث
Route::get('/search', [SearchController::class, 'search'])->name('search');

// التعليقات والإعجابات (تحتاج تسجيل دخول)
Route::middleware('auth')->group(function () {
    Route::post('/post/{id}/comment', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/post/{id}/like', [CommentController::class, 'like'])->name('posts.like');
});

// لوحة التحكم (للمشرفين فقط)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // إدارة المنشورات
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // إدارة الأقسام
    Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    
    // إدارة المستخدمين
    Route::post('/user/{id}', function ($id, \Illuminate\Http\Request $request) {
        $user = \App\Models\User::findOrFail($id);
        $user->usertype = $request->usertype;
        $user->save();
        return back()->with('success', 'تم تحديث صلاحية المستخدم');
    })->name('user.edit');
});

// صفحة Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// إدارة الملف الشخصي
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

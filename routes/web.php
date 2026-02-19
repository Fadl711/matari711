<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// الصفحة الرئيسية
Route::get('/', [SectionController::class, 'welcome'])->name('home');

// عرض منشورات قسم معين
Route::get('/section/{id}', [SectionController::class, 'showSection'])->name('posts.section');

// عرض منشور معين
Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');

// عرض كتاب PDF في المتصفح
Route::get('/post/{id}/book', [PostController::class, 'viewBook'])->name('posts.viewBook');

// البحث
Route::get('/search', [SearchController::class, 'search'])->name('search');

// صفحة تعريف بالشيخ
Route::get('/about', function () {
    return view('about');
})->name('about');

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
    Route::post('/posts/{id}/toggle-pin', [PostController::class, 'togglePin'])->name('posts.togglePin');

    // إدارة الأقسام
    Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    Route::put('/sections/{id}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/sections/{id}', [SectionController::class, 'destroy'])->name('sections.destroy');
    Route::post('/sections/reorder', [SectionController::class, 'reorder'])->name('sections.reorder');

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
    $totalPosts = \App\Models\Post::count();
    $totalViews = \App\Models\Post::sum('views');
    $totalSections = \App\Models\Section::count();
    $posts = \App\Models\Post::with('section')->latest()->paginate(15);
    $mostViewedPosts = \App\Models\Post::with('section')->orderBy('views', 'desc')->take(5)->get();

    return view('dashboard', compact('totalPosts', 'totalViews', 'totalSections', 'posts', 'mostViewedPosts'));
})->middleware(['auth', 'verified'])->name('dashboard');

// إدارة الملف الشخصي
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

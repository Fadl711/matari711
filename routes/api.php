<?php

use App\Http\Controllers\Api\MobileApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for Mobile App
|--------------------------------------------------------------------------
*/

// قائمة الأقسام
Route::get('/sections', [MobileApiController::class, 'sections']);

// قائمة المنشورات حسب القسم
Route::get('/posts/{sectionId}', [MobileApiController::class, 'posts']);

// تفاصيل منشور معين
Route::get('/post/{id}', [MobileApiController::class, 'postDetail']);

// التعليقات على منشور
Route::get('/post/{id}/comments', [MobileApiController::class, 'comments']);

// أحدث المنشورات (للصفحة الرئيسية)
Route::get('/latest-posts', [MobileApiController::class, 'latestPosts']);

// البحث
Route::get('/search', [MobileApiController::class, 'search']);

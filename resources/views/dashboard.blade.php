@extends('layout')

@section('title', 'لوحة التحكم - د. محمد المطري')

@section('content')
    <div class="min-h-screen bg-cream-50 py-8">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-brown-700 mb-2">
                        <i class="fas fa-tachometer-alt text-primary-600 ml-2"></i>
                        لوحة التحكم
                    </h1>
                    <p class="text-brown-500">مرحباً بك، {{ Auth::user()->name }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                        <i class="fas fa-user-circle"></i>
                        <span>الملف الشخصي</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>خروج</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Posts -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-brown-500 text-sm mb-1">إجمالي المنشورات</p>
                            <h3 class="text-3xl font-bold text-brown-700">{{ $totalPosts }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-file-alt text-primary-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Views -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-brown-500 text-sm mb-1">إجمالي المشاهدات</p>
                            <h3 class="text-3xl font-bold text-brown-700">{{ number_format($totalViews) }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-eye text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Sections -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-brown-500 text-sm mb-1">الأقسام</p>
                            <h3 class="text-3xl font-bold text-brown-700">{{ $totalSections }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-layer-group text-green-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Average Views -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-brown-500 text-sm mb-1">متوسط المشاهدات</p>
                            <h3 class="text-3xl font-bold text-brown-700">
                                {{ $totalPosts > 0 ? number_format($totalViews / $totalPosts, 0) : 0 }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-gold-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-gold-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-cream-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-brown-700">
                            <i class="fas fa-list text-primary-600 ml-2"></i>
                            المنشورات الأخيرة
                        </h2>
                        <a href="{{ route('admin.posts.create') }}"
                            class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors inline-flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>إضافة منشور جديد</span>
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-full">
                        <thead class="bg-cream-50">
                            <tr>
                                <th class="px-4 md:px-6 py-3 text-right text-sm font-semibold text-brown-700">#</th>
                                <th class="px-4 md:px-6 py-3 text-right text-sm font-semibold text-brown-700">العنوان</th>
                                <th
                                    class="px-4 md:px-6 py-3 text-right text-sm font-semibold text-brown-700 hidden sm:table-cell">
                                    القسم</th>
                                <th class="px-4 md:px-6 py-3 text-right text-sm font-semibold text-brown-700">المشاهدات</th>
                                <th
                                    class="px-4 md:px-6 py-3 text-right text-sm font-semibold text-brown-700 hidden md:table-cell">
                                    التاريخ</th>
                                <th class="px-4 md:px-6 py-3 text-right text-sm font-semibold text-brown-700">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse($posts as $index => $post)
                                <tr class="hover:bg-cream-50 transition-colors">
                                    <td class="px-4 md:px-6 py-4 text-brown-600 text-sm">
                                        {{ $posts->firstItem() + $index }}
                                    </td>
                                    <td class="px-4 md:px-6 py-4">
                                        <a href="{{ route('posts.show', $post->id) }}"
                                            class="text-brown-700 hover:text-primary-600 font-medium transition-colors text-sm">
                                            {{ Str::limit($post->title, 40) }}
                                        </a>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 hidden sm:table-cell">
                                        <span
                                            class="inline-flex items-center gap-1 bg-primary-100 text-primary-700 px-2 py-1 rounded-full text-xs">
                                            <i class="fas {{ $post->section->icon ?? 'fa-folder' }} text-xs"></i>
                                            <span class="hidden lg:inline">{{ $post->section->name ?? 'بدون قسم' }}</span>
                                        </span>
                                    </td>
                                    <td class="px-4 md:px-6 py-4">
                                        <div class="flex items-center gap-1 text-brown-600 text-sm">
                                            <i class="fas fa-eye text-blue-500 text-xs"></i>
                                            <span class="font-semibold">{{ number_format($post->views) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 text-brown-500 text-xs hidden md:table-cell">
                                        {{ $post->created_at->format('Y-m-d') }}
                                    </td>
                                    <td class="px-4 md:px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('posts.show', $post->id) }}"
                                                class="text-blue-600 hover:text-blue-700 transition-colors" title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                class="text-green-600 hover:text-green-700 transition-colors"
                                                title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا المنشور؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 transition-colors"
                                                    title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-brown-400">
                                        <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                                        <p>لا توجد منشورات بعد</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($posts->hasPages())
                    <div class="p-4 md:p-6 border-t border-cream-200">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-brown-600">
                                عرض {{ $posts->firstItem() }} إلى {{ $posts->lastItem() }} من أصل {{ $posts->total() }}
                                منشور
                            </div>
                            <div class="pagination-wrapper">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Most Viewed Posts -->
            @if ($mostViewedPosts->count() > 0)
                <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-brown-700 mb-6">
                        <i class="fas fa-fire text-red-500 ml-2"></i>
                        المنشورات الأكثر مشاهدة
                    </h2>
                    <div class="space-y-4">
                        @foreach ($mostViewedPosts as $post)
                            <div
                                class="flex items-center justify-between p-4 bg-cream-50 rounded-lg hover:bg-cream-100 transition-colors">
                                <div class="flex-1">
                                    <a href="{{ route('posts.show', $post->id) }}"
                                        class="text-brown-700 hover:text-primary-600 font-medium transition-colors">
                                        {{ Str::limit($post->title, 60) }}
                                    </a>
                                    <p class="text-sm text-brown-500 mt-1">
                                        {{ $post->section->name ?? 'بدون قسم' }} •
                                        {{ $post->created_at->format('Y-m-d') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 text-blue-600 font-bold">
                                    <i class="fas fa-eye"></i>
                                    <span>{{ number_format($post->views) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <style>
            /* Fix pagination on mobile */
            .pagination-wrapper nav {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .pagination-wrapper nav .flex {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .pagination-wrapper nav a,
            .pagination-wrapper nav span {
                min-width: 40px;
                min-height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0.5rem;
                touch-action: manipulation;
            }

            /* Hide default English pagination text */
            .pagination-wrapper nav p {
                display: none !important;
            }
        </style>
    @endpush
@endsection

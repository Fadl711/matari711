@extends('layout')

@section('title', 'رواق العلوم الشرعية - الرئيسية')

@section('content')
    <!-- Hero Section -->
    <section class="islamic-gradient relative overflow-hidden">
        <!-- نمط إسلامي خلفي -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 80 80\"><path fill=\"%23ffffff\" d=\"M40 0L80 40L40 80L0 40z\" opacity=\"0.1\"/></svg>'); background-size: 40px 40px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 relative z-10">
            <div class="text-center">
                <!-- الأيقونة -->
                <div
                    class="inline-flex items-center justify-center w-20 h-20 md:w-24 md:h-24 bg-gold-500/20 rounded-full mb-6">
                    <i class="fas fa-mosque text-gold-400 text-4xl md:text-5xl"></i>
                </div>

                <!-- العنوان الرئيسي -->
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 font-arabic">
                    رواق العلوم الشرعية
                </h1>

                <!-- اسم الشيخ -->
                <p class="text-xl md:text-2xl text-gold-300 mb-6">
                    د. محمد بن علي بن جميل المطري
                </p>

                <!-- الوصف -->
                <p class="text-primary-100 text-base md:text-lg max-w-2xl mx-auto mb-8 leading-relaxed">
                    منصة علمية شرعية تقدم المقالات والكتب والفتاوى والدروس الصوتية والمرئية
                    <br class="hidden md:block">
                    لنشر العلم النافع وبيان أحكام الشريعة الإسلامية
                </p>

                <!-- أزرار الإجراء -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#sections"
                        class="inline-flex items-center justify-center gap-2 bg-gold-500 text-primary-900 px-8 py-3 rounded-full font-bold hover:bg-gold-400 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-book-open"></i>
                        <span>تصفح المحتوى</span>
                    </a>
                    <a href="#latest"
                        class="inline-flex items-center justify-center gap-2 border-2 border-white/30 text-white px-8 py-3 rounded-full font-medium hover:bg-white/10 transition-all duration-300">
                        <i class="fas fa-clock"></i>
                        <span>أحدث المنشورات</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- موجة سفلية -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                    class="fill-cream-100" />
            </svg>
        </div>
    </section>

    <!-- قسم الأقسام -->
    <section id="sections" class="py-12 md:py-20 bg-cream-100">
        <div class="max-w-7xl mx-auto px-4">
            <!-- عنوان القسم -->
            <div class="text-center mb-12">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-1 rounded-full text-sm font-medium mb-4">
                    استكشف المحتوى
                </span>
                <h2 class="text-2xl md:text-4xl font-bold text-brown-700 mb-4">الأقسام الرئيسية</h2>
                <p class="text-brown-500 max-w-xl mx-auto">
                    تصفح أقسام الموقع واختر ما يناسبك من المحتوى العلمي الشرعي
                </p>
            </div>

            <!-- شبكة الأقسام -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach ($sections as $section)
                    <a href="{{ route('posts.section', $section->id) }}"
                        class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-all duration-300 card-hover border border-cream-300">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                            <i class="fas {{ $section->icon }} text-2xl text-white"></i>
                        </div>
                        <h3 class="font-bold text-brown-700 text-lg mb-2">{{ $section->name }}</h3>
                        <p class="text-sm text-brown-400">
                            {{ $section->posts->count() }} منشور
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- أحدث المنشورات لكل قسم -->
    <section id="latest" class="py-12 md:py-20 bg-cream-200">
        <div class="max-w-7xl mx-auto px-4">
            @foreach ($sections as $section)
                @if ($section->posts->count() > 0)
                    <!-- عنوان القسم -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b-2 border-primary-500 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
                                <i class="fas {{ $section->icon }} text-white"></i>
                            </div>
                            <h2 class="text-xl md:text-2xl font-bold text-brown-700">{{ $section->name }}</h2>
                        </div>
                        <a href="{{ route('posts.section', $section->id) }}"
                            class="text-primary-600 hover:text-primary-700 font-medium flex items-center gap-2 group">
                            <span>عرض الكل</span>
                            <i class="fas fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
                        </a>
                    </div>

                    <!-- شبكة المنشورات -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
                        @foreach ($section->posts->take(3) as $post)
                            <article
                                class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover group cursor-pointer flex flex-col h-full"
                                onclick="window.location='{{ route('posts.show', $post->id) }}'">
                                <!-- صورة المنشور -->
                                <div class="relative h-48 overflow-hidden">
                                    @if ($post->image)
                                        <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-primary-600 flex items-center justify-center">
                                            <i class="fas fa-mosque text-white text-5xl opacity-50"></i>
                                        </div>
                                    @endif

                                    <!-- شارة القسم -->
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="bg-gold-500 text-primary-900 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $section->name }}
                                        </span>
                                    </div>
                                </div>

                                <!-- محتوى البطاقة -->
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3
                                        class="font-bold text-brown-700 text-lg mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                        <a href="{{ route('posts.show', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    @if ($post->body)
                                        <p class="text-brown-500 text-sm line-clamp-2 mb-4 leading-relaxed">
                                            {{ Str::limit(strip_tags($post->body), 100) }}
                                        </p>
                                    @endif

                                    <!-- معلومات إضافية -->
                                    <div
                                        class="mt-auto flex items-center justify-between text-sm text-brown-400 pt-4 border-t border-cream-200">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $post->created_at->locale('ar')->diffForHumans() }}
                                        </span>
                                        <a href="{{ route('posts.show', $post->id) }}"
                                            class="text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                                            <span>اقرأ المزيد</span>
                                            <i class="fas fa-arrow-left text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <!-- قسم الإحصائيات -->
    <section class="py-12 md:py-16 islamic-gradient">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $totalPosts = \App\Models\Post::count();
                    $totalSections = \App\Models\Section::count();
                @endphp

                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">{{ $totalPosts }}</div>
                    <div class="text-primary-100">منشور</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">{{ $totalSections }}</div>
                    <div class="text-primary-100">قسم</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="text-primary-100">محتوى متنوع</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="text-primary-100">علم نافع</div>
                </div>
            </div>
        </div>
    </section>
@endsection

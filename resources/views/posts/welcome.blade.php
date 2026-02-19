@extends('layout')

@section('title', 'الشيخ الدكتور محمد المطري - الموقع الرسمي')
@section('meta_title', 'الموقع الرسمي للشيخ الدكتور محمد بن علي بن جميل المطري')
@section('meta_description',
    'الموقع الرسمي للشيخ الدكتور محمد المطري، يحتوي على مجموعة كبيرة من الخطب والدروس الصوتية
    والمرئية والفتاوى والمقالات في التفسير وعلوم القرآن والفقه.')
@section('meta_keywords',
    'محمد المطري، الشيخ المطري، التفسير، علوم القرآن، الحديدة، اليمن، فتاوى، كتب إسلامية، خطب
    جمعة')

@section('og_title', 'الشيخ الدكتور محمد المطري - الموقع الرسمي')
@section('og_description', 'موقع علمي دعوي شامل للشيخ الدكتور محمد المطري لنشر العلم الشرعي الصحيح.')
@section('og_image', asset('R.png'))

@section('content')
    <!-- Hero Section -->
    <section class="islamic-gradient relative overflow-hidden">
        <!-- نمط إسلامي خلفي -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 80 80&quot;><path fill=&quot;%23ffffff&quot; d=&quot;M40 0L80 40L40 80L0 40z&quot; opacity=&quot;0.1&quot;/></svg>'); background-size: 40px 40px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-12 md:py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Right Side: Text -->
                <div class="text-center lg:text-right order-1">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-gold-500/20 rounded-full mb-5">
                        <i class="fas fa-mosque text-gold-400 text-3xl md:text-4xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3 font-arabic leading-tight">
                        الموقع الرسمي
                    </h1>
                    <p class="text-xl md:text-2xl text-gold-300 mb-3 font-arabic">
                        للشيخ الدكتور <br class="sm:hidden">
                        <span class="font-bold">محمد بن علي بن جميل المطري</span>
                    </p>
                    <p class="text-primary-100 text-base md:text-lg max-w-lg mx-auto lg:mx-0 mb-8 leading-relaxed">
                        لنشر العلم النافع من مقالات وكتب وفتاوى ودروس صوتية ومرئية
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#sections"
                            class="inline-flex items-center justify-center gap-2 bg-gold-500 text-primary-900 px-8 py-3 rounded-full font-bold hover:bg-gold-400 transition-all duration-300 transform hover:scale-105 shadow-lg">
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

                <!-- Left Side: Sheikh Photo -->
                <div class="order-2 flex justify-center lg:justify-end">
                    <div class="relative group">
                        <div
                            class="absolute -inset-4 bg-gradient-to-br from-gold-500 via-gold-400 to-gold-600 rounded-3xl blur-xl opacity-50 group-hover:opacity-75 transition-opacity duration-500">
                        </div>
                        <div class="relative">
                            <div
                                class="overflow-hidden rounded-3xl border-4 border-gold-400/50 shadow-2xl transform group-hover:scale-[1.02] transition-transform duration-500">
                                <img src="{{ asset('sheikh-photo.jpg') }}" alt="الشيخ الدكتور محمد المطري"
                                    class="w-full max-w-md h-auto object-cover" style="max-height: 500px;">
                            </div>
                            <div class="absolute -top-6 -right-6 w-24 h-24 bg-gold-500/20 rounded-full blur-2xl"></div>
                            <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary-400/20 rounded-full blur-2xl">
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-white rounded-2xl shadow-xl px-6 py-3 min-w-max">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-white text-lg"></i>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-brown-500">دكتوراه في</p>
                                    <p class="text-sm font-bold text-brown-700">التفسير وعلوم القرآن</p>
                                </div>
                            </div>
                        </div>
                    </div>
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

    {{-- ========================================== --}}
    {{-- 📌 المنشورات المثبّتة (Featured Carousel)  --}}
    {{-- ========================================== --}}
    @php
        $pinnedPosts = \App\Models\Post::where('is_pinned', true)->with('section')->latest()->take(8)->get();
    @endphp

    @if ($pinnedPosts->count() > 0)
        <section class="py-10 md:py-16 bg-cream-50 overflow-hidden" x-data="{
            scrollLeft() {
                    this.$refs.scroller.scrollBy({
                        left: -320,
                        behavior: 'smooth'
                    });
                },
                scrollRight() {
                    this.$refs.scroller.scrollBy({
                        left: 320,
                        behavior: 'smooth'
                    });
                }
        }">
            <div class="max-w-7xl mx-auto px-4 relative">
                <!-- رأس القسم مع الأزرار -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-gold-400 to-gold-600 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                            <i class="fas fa-star text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-brown-800 font-arabic">مختارات مميزة</h2>
                            <p class="text-brown-500 text-sm mt-1"> من أهم المقالات والدروس</p>
                        </div>
                    </div>

                    <!-- أزرار التحكم -->
                    <div class="flex items-center gap-2" dir="ltr">
                        <button @click="scrollLeft()"
                            class="w-10 h-10 rounded-full border border-brown-200 text-brown-600 hover:bg-gold-500 hover:text-white hover:border-gold-500 transition-all shadow-sm flex items-center justify-center bg-white">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <button @click="scrollRight()"
                            class="w-10 h-10 rounded-full border border-brown-200 text-brown-600 hover:bg-gold-500 hover:text-white hover:border-gold-500 transition-all shadow-sm flex items-center justify-center bg-white">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- الكاروسيل -->
                <div x-ref="scroller"
                    class="flex gap-5 overflow-x-auto snap-x snap-mandatory pb-8 pt-2 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]"
                    style="-webkit-overflow-scrolling: touch;">

                    @foreach ($pinnedPosts as $post)
                        <div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[32%] snap-start">
                            <article
                                class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover group cursor-pointer flex flex-col h-full"
                                onclick="window.location='{{ route('posts.show', $post->id) }}'">
                                <div class="relative h-56 overflow-hidden bg-gray-100">
                                    @if ($post->image)
                                        <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-primary-600 flex items-center justify-center">
                                            <i class="fas fa-mosque text-white text-5xl opacity-50"></i>
                                        </div>
                                    @endif
                                    @if ($post->is_pinned)
                                        <div
                                            class="absolute top-4 right-4 bg-gold-500 text-primary-900 px-3 py-1 rounded-full text-xs font-bold">
                                            <i class="fas fa-thumbtack ml-1"></i> مثبّت
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3
                                        class="font-bold text-brown-700 text-lg mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                        {{ $post->title }}
                                    </h3>
                                    @if ($post->body)
                                        <p class="text-brown-500 text-sm line-clamp-3 mb-4 leading-relaxed">
                                            {{ Str::limit(strip_tags($post->body), 100) }}
                                        </p>
                                    @endif
                                    <div
                                        class="mt-auto flex items-center justify-between text-sm text-brown-400 pt-4 border-t border-cream-200">
                                        <span>{{ $post->created_at->locale('ar')->diffForHumans() }}</span>
                                        <span class="text-primary-600 font-medium">اقرأ المزيد ←</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach

                    <!-- بطاقة "عرض الكل" في النهاية -->
                    <div class="min-w-[40%] sm:min-w-[25%] lg:min-w-[15%] snap-center flex items-center justify-center">
                        <a href="#latest"
                            class="group flex flex-col items-center justify-center gap-4 w-full h-4/5 border-2 border-dashed border-gold-300 rounded-3xl text-gold-600 hover:bg-gold-50 hover:border-gold-500 transition-all p-6 text-center">
                            <div
                                class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-arrow-left text-2xl"></i>
                            </div>
                            <span class="font-bold">تصفح المزيد</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif



    {{-- ========================================== --}}
    {{-- 📰 أحدث المنشورات لكل قسم                 --}}
    {{-- ========================================== --}}
    <section id="latest" class="py-10 md:py-16 bg-cream-100">
        <div class="max-w-7xl mx-auto px-4">
            <!-- عنوان عام -->
            <div class="text-center mb-10">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-1 rounded-full text-sm font-medium mb-3">
                    <i class="fas fa-sparkles ml-1"></i> أحدث المحتوى
                </span>
                <h2 class="text-2xl md:text-3xl font-bold text-brown-700">تصفح أحدث المنشورات</h2>
            </div>

            @foreach ($sections as $sIndex => $section)
                @if ($section->posts->count() > 0)
                    <!-- عنوان القسم -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 mt-{{ $sIndex > 0 ? '14' : '0' }}">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-11 h-11 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas {{ $section->icon }} text-white text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg md:text-xl font-bold text-brown-700">{{ $section->name }}</h2>
                                <p class="text-xs text-brown-400">{{ $section->posts->count() }} منشور</p>
                            </div>
                        </div>
                        <a href="{{ route('posts.section', $section->id) }}"
                            class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium text-sm bg-primary-50 hover:bg-primary-100 px-4 py-2 rounded-full transition-all group">
                            <span>عرض الكل</span>
                            <i
                                class="fas fa-arrow-left text-xs transform group-hover:-translate-x-1 transition-transform"></i>
                        </a>
                    </div>

                    @php $sectionPosts = $section->posts->take(5); @endphp

                    @if ($sectionPosts->count() >= 3)
                        <!-- تصميم: بطاقة كبيرة يسار + بطاقتين يمين -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-6">
                            <!-- البطاقة الرئيسية الكبيرة -->
                            <article
                                class="lg:col-span-7 group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer flex flex-col"
                                onclick="window.location='{{ route('posts.show', $sectionPosts[0]->id) }}'">
                                <div class="relative h-56 md:h-72 overflow-hidden bg-gray-100">
                                    @if ($sectionPosts[0]->image)
                                        <img src="{{ $sectionPosts[0]->image }}" alt="{{ $sectionPosts[0]->title }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full islamic-gradient flex items-center justify-center">
                                            <i class="fas fa-mosque text-white text-6xl opacity-30"></i>
                                        </div>
                                    @endif
                                    @if ($sectionPosts[0]->is_pinned)
                                        <div
                                            class="absolute top-4 right-4 bg-gold-500 text-primary-900 px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                            <i class="fas fa-thumbtack"></i> مثبّت
                                        </div>
                                    @endif
                                    {{-- نوع المحتوى --}}
                                    <div class="absolute bottom-4 right-4 flex gap-2">
                                        @if ($sectionPosts[0]->fileAud)
                                            <span
                                                class="bg-black/50 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs">
                                                <i class="fas fa-headphones"></i>
                                            </span>
                                        @endif
                                        @if ($sectionPosts[0]->fileVid || $sectionPosts[0]->link_video)
                                            <span
                                                class="bg-black/50 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs">
                                                <i class="fas fa-play"></i>
                                            </span>
                                        @endif
                                        @if ($sectionPosts[0]->books)
                                            <span
                                                class="bg-black/50 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs">
                                                <i class="fas fa-book"></i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-5 md:p-6 flex flex-col flex-grow">
                                    <h3
                                        class="font-bold text-brown-700 text-lg md:text-xl mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors leading-relaxed">
                                        {{ $sectionPosts[0]->title }}
                                    </h3>
                                    @if ($sectionPosts[0]->body)
                                        <p class="text-brown-500 text-sm line-clamp-3 mb-4 leading-relaxed">
                                            {{ Str::limit(strip_tags($sectionPosts[0]->body), 180) }}
                                        </p>
                                    @endif
                                    <div
                                        class="mt-auto flex items-center justify-between text-sm text-brown-400 pt-4 border-t border-cream-200">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $sectionPosts[0]->created_at->locale('ar')->diffForHumans() }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-eye"></i>
                                            {{ $sectionPosts[0]->views ?? 0 }}
                                        </span>
                                    </div>
                                </div>
                            </article>

                            <!-- البطاقات الجانبية -->
                            <div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                                @foreach ($sectionPosts->skip(1)->take(4) as $post)
                                    <article
                                        class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer flex flex-row h-full"
                                        onclick="window.location='{{ route('posts.show', $post->id) }}'">
                                        <!-- صورة مصغرة -->
                                        <div class="relative w-28 sm:w-32 flex-shrink-0 overflow-hidden bg-gray-100">
                                            @if ($post->image)
                                                <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full bg-primary-600 flex items-center justify-center">
                                                    <i class="fas fa-mosque text-white text-2xl opacity-50"></i>
                                                </div>
                                            @endif
                                            @if ($post->is_pinned)
                                                <div
                                                    class="absolute top-2 right-2 bg-gold-500 text-primary-900 w-6 h-6 rounded-full flex items-center justify-center shadow">
                                                    <i class="fas fa-thumbtack text-[10px]"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- المحتوى -->
                                        <div class="p-3 flex flex-col justify-center flex-grow min-w-0">
                                            <h4
                                                class="font-bold text-brown-700 text-sm mb-1.5 line-clamp-2 group-hover:text-primary-600 transition-colors leading-relaxed">
                                                {{ $post->title }}
                                            </h4>
                                            <div class="flex items-center gap-3 text-xs text-brown-400">
                                                <span class="flex items-center gap-1">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    {{ $post->created_at->locale('ar')->diffForHumans() }}
                                                </span>
                                                @if ($post->fileAud)
                                                    <i class="fas fa-headphones text-primary-500"></i>
                                                @endif
                                                @if ($post->fileVid || $post->link_video)
                                                    <i class="fas fa-play text-red-500"></i>
                                                @endif
                                                @if ($post->books)
                                                    <i class="fas fa-book text-gold-500"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- أقل من 3 منشورات: عرض عادي -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
                            @foreach ($sectionPosts as $post)
                                <article
                                    class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover group cursor-pointer flex flex-col h-full"
                                    onclick="window.location='{{ route('posts.show', $post->id) }}'">
                                    <div class="relative h-48 overflow-hidden bg-gray-100">
                                        @if ($post->image)
                                            <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full bg-primary-600 flex items-center justify-center">
                                                <i class="fas fa-mosque text-white text-5xl opacity-50"></i>
                                            </div>
                                        @endif
                                        @if ($post->is_pinned)
                                            <div
                                                class="absolute top-4 right-4 bg-gold-500 text-primary-900 px-3 py-1 rounded-full text-xs font-bold">
                                                <i class="fas fa-thumbtack ml-1"></i> مثبّت
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-5 flex flex-col flex-grow">
                                        <h3
                                            class="font-bold text-brown-700 text-lg mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                            {{ $post->title }}
                                        </h3>
                                        @if ($post->body)
                                            <p class="text-brown-500 text-sm line-clamp-2 mb-4 leading-relaxed">
                                                {{ Str::limit(strip_tags($post->body), 100) }}
                                            </p>
                                        @endif
                                        <div
                                            class="mt-auto flex items-center justify-between text-sm text-brown-400 pt-4 border-t border-cream-200">
                                            <span>{{ $post->created_at->locale('ar')->diffForHumans() }}</span>
                                            <span class="text-primary-600 font-medium">اقرأ المزيد ←</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- 📊 الإحصائيات                              --}}
    {{-- ========================================== --}}
    <section class="py-12 md:py-16 islamic-gradient relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 80 80&quot;><path fill=&quot;%23ffffff&quot; d=&quot;M40 0L80 40L40 80L0 40z&quot; opacity=&quot;0.1&quot;/></svg>'); background-size: 40px 40px;">
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">في أرقام</h2>
                <div class="w-16 h-1 bg-gold-500 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $totalPosts = \App\Models\Post::count();
                    $totalSections = \App\Models\Section::count();
                    $totalViews = \App\Models\Post::sum('views');
                    $totalAudio = \App\Models\Post::whereNotNull('fileAud')->count();
                @endphp

                <div
                    class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-colors">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">{{ $totalPosts }}</div>
                    <div class="text-primary-100 text-sm">منشور علمي</div>
                </div>
                <div
                    class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-colors">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">{{ $totalSections }}</div>
                    <div class="text-primary-100 text-sm">قسم متنوع</div>
                </div>
                <div
                    class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-colors">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">
                        {{ number_format($totalViews) }}
                    </div>
                    <div class="text-primary-100 text-sm">مشاهدة</div>
                </div>
                <div
                    class="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-colors">
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">{{ $totalAudio }}</div>
                    <div class="text-primary-100 text-sm">مادة صوتية</div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            /* إخفاء scrollbar مع الحفاظ على التمرير */
            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
        </style>
    @endpush
@endsection

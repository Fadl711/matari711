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
    <!-- Hero Section with Sheikh Photo -->
    <section class="islamic-gradient relative overflow-hidden">
        <!-- نمط إسلامي خلفي -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 80 80\"><path fill=\"%23ffffff\" d=\"M40 0L80 40L40 80L0 40z\" opacity=\"0.1\"/></svg>'); background-size: 40px 40px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-12 md:py-20 relative z-10">
            <!-- Grid Layout: Photo + Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

                <!-- Right Side: Text Content -->
                <div class="text-center lg:text-right order-1 lg:order-1">
                    <!-- الأيقونة -->
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-gold-500/20 rounded-full mb-5">
                        <i class="fas fa-mosque text-gold-400 text-3xl md:text-4xl"></i>
                    </div>

                    <!-- العنوان الرئيسي -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3 font-arabic leading-tight">
                        الموقع الرسمي
                    </h1>

                    <!-- اسم الشيخ -->
                    <p class="text-xl md:text-2xl text-gold-300 mb-3 font-arabic">
                        للشيخ الدكتور <br class="sm:hidden">
                        <span class="font-bold">محمد بن علي بن جميل المطري</span>
                    </p>

                    <!-- الوصف -->
                    <p class="text-primary-100 text-base md:text-lg max-w-lg mx-auto lg:mx-0 mb-8 leading-relaxed">
                        لنشر العلم النافع من مقالات وكتب وفتاوى ودروس صوتية ومرئية
                    </p>

                    <!-- أزرار الإجراء -->
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
                <div class="order-2 lg:order-2 flex justify-center lg:justify-end">
                    <div class="relative group">
                        <!-- الإطار الخارجي الذهبي -->
                        <div
                            class="absolute -inset-4 bg-gradient-to-br from-gold-500 via-gold-400 to-gold-600 rounded-3xl blur-xl opacity-50 group-hover:opacity-75 transition-opacity duration-500">
                        </div>

                        <!-- صورة الشيخ -->
                        <div class="relative">
                            <div
                                class="overflow-hidden rounded-3xl border-4 border-gold-400/50 shadow-2xl transform group-hover:scale-[1.02] transition-transform duration-500">
                                <img src="{{ asset('sheikh-photo.jpg') }}" alt="الشيخ الدكتور محمد المطري"
                                    class="w-full max-w-md h-auto object-cover" style="max-height: 500px;">
                            </div>

                            <!-- زخرفة إسلامية -->
                            <div class="absolute -top-6 -right-6 w-24 h-24 bg-gold-500/20 rounded-full blur-2xl"></div>
                            <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary-400/20 rounded-full blur-2xl"></div>
                        </div>

                        <!-- شارة تعريفية أسفل الصورة -->
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
                                <div class="relative h-48 overflow-hidden bg-gray-100">
                                    @if ($post->image)
                                        <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                            class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
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

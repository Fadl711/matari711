@extends('layout')

@section('title', $section->name . ' - رواق العلوم الشرعية')

@section('content')
<!-- رأس الصفحة -->
<section class="islamic-gradient py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gold-500/20 rounded-full mb-4">
            <i class="fas {{ $section->icon }} text-gold-400 text-3xl"></i>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $section->name }}</h1>
        <p class="text-primary-100 max-w-xl mx-auto">
            تصفح جميع منشورات قسم {{ $section->name }}
        </p>
        <div class="mt-4">
            <span class="inline-block bg-gold-500/20 text-gold-300 px-4 py-2 rounded-full text-sm">
                {{ $posts->total() }} منشور
            </span>
        </div>
    </div>
</section>

<!-- المحتوى الرئيسي -->
<section class="py-12 md:py-16 bg-cream-100">
    <div class="max-w-7xl mx-auto px-4">
        
        @auth
            @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                <!-- أزرار الإدارة -->
                <div class="mb-8 flex gap-4">
                    <a href="{{ route('admin.posts.create') }}" 
                       class="inline-flex items-center gap-2 bg-primary-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-primary-600 transition-colors">
                        <i class="fas fa-plus"></i>
                        <span>إضافة منشور جديد</span>
                    </a>
                </div>
            @endif
        @endauth
        
        @if($posts->count() > 0)
            <!-- شبكة المنشورات -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover group">
                        <!-- صورة المنشور -->
                        <div class="relative h-48 sm:h-52 overflow-hidden">
                            @if($post->image)
                                <img src="{{ $post->image }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                                    <i class="fas {{ $section->icon }} text-5xl text-white/50"></i>
                                </div>
                            @endif
                            
                            @auth
                                @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                                    <!-- أزرار التحكم -->
                                    <div class="absolute top-4 left-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" 
                                           class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 rounded-full flex items-center justify-center text-white shadow-lg">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المنشور؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-10 h-10 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white shadow-lg">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        
                        <!-- محتوى البطاقة -->
                        <div class="p-5">
                            <h3 class="font-bold text-brown-700 text-lg mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                <a href="{{ route('posts.show', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            @if($post->body)
                                <p class="text-brown-500 text-sm line-clamp-3 mb-4 leading-relaxed">
                                    {{ Str::limit(strip_tags($post->body), 120) }}
                                </p>
                            @endif
                            
                            <!-- معلومات إضافية -->
                            <div class="flex items-center justify-between text-sm text-brown-400 pt-4 border-t border-cream-200">
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $post->created_at->diffForHumans() }}
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
            
            <!-- التنقل بين الصفحات -->
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            <!-- رسالة عدم وجود منشورات -->
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-cream-200 rounded-full flex items-center justify-center">
                    <i class="fas {{ $section->icon }} text-4xl text-brown-300"></i>
                </div>
                <h3 class="text-xl font-bold text-brown-600 mb-2">لا توجد منشورات حتى الآن</h3>
                <p class="text-brown-400">سيتم إضافة المحتوى قريباً إن شاء الله</p>
            </div>
        @endif
    </div>
</section>
@endsection

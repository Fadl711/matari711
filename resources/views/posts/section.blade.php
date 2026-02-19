@extends('layout')

@section('title', $section->name . ' - د.محمد بن جميل المطري')

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

    <!-- الأقسام الفرعية -->
    @if ($section->is_parent && $section->children->count() > 0)
        <section class="bg-white border-b border-cream-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex items-center gap-3 flex-wrap justify-center">
                    <!-- زر الكل -->
                    <a href="{{ route('posts.section', $section->id) }}"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all
                        {{ !request('sub') ? 'bg-primary-600 text-white shadow-md' : 'bg-cream-100 text-brown-600 hover:bg-cream-200' }}">
                        <i class="fas fa-th-large ml-1"></i>
                        الكل ({{ $posts->total() }})
                    </a>

                    <!-- أزرار الأقسام الفرعية -->
                    @foreach ($section->children as $child)
                        <a href="{{ route('posts.section', $child->id) }}"
                            class="px-5 py-2 rounded-full text-sm font-medium transition-all
                            bg-cream-100 text-brown-600 hover:bg-primary-100 hover:text-primary-700">
                            <i class="fas {{ $child->icon }} ml-1"></i>
                            {{ $child->name }}
                            <span class="text-xs opacity-70">({{ $child->posts()->count() }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- إذا كان قسم فرعي: اعرض مسار التصفح -->
    @if ($section->is_child)
        <section class="bg-white border-b border-cream-200">
            <div class="max-w-7xl mx-auto px-4 py-3">
                <nav class="flex items-center gap-2 text-sm text-brown-500">
                    <a href="{{ route('home') }}" class="hover:text-primary-600">
                        <i class="fas fa-home"></i> الرئيسية
                    </a>
                    <i class="fas fa-chevron-left text-xs"></i>
                    <a href="{{ route('posts.section', $section->parent->id) }}" class="hover:text-primary-600">
                        {{ $section->parent->name }}
                    </a>
                    <i class="fas fa-chevron-left text-xs"></i>
                    <span class="text-primary-600 font-medium">{{ $section->name }}</span>
                </nav>
            </div>
        </section>
    @endif

    <!-- المحتوى الرئيسي -->
    <section class="py-12 md:py-16 bg-cream-100">
        <div class="max-w-7xl mx-auto px-4">

            @auth
                @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
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

            @if ($posts->count() > 0)
                <!-- شبكة المنشورات -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        <article
                            class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover group cursor-pointer flex flex-col h-full"
                            onclick="window.location='{{ route('posts.show', $post->id) }}'">
                            <!-- صورة المنشور -->
                            <div class="relative h-48 sm:h-52 overflow-hidden bg-gray-100">
                                @if ($post->image)
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-primary-600 flex items-center justify-center">
                                        <i class="fas fa-mosque text-white text-5xl opacity-50"></i>
                                    </div>
                                @endif

                                {{-- شارة المثبّت --}}
                                @if ($post->is_pinned)
                                    <div
                                        class="absolute top-4 right-4 bg-gold-500 text-primary-900 px-3 py-1 rounded-full text-sm font-bold flex items-center gap-1 shadow-lg">
                                        <i class="fas fa-thumbtack"></i> مثبّت
                                    </div>
                                @endif

                                @auth
                                    @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                                        <!-- أزرار التحكم -->
                                        <div class="absolute top-4 left-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity"
                                            onclick="event.stopPropagation()">
                                            {{-- زر التثبيت --}}
                                            <button type="button" onclick="togglePin({{ $post->id }}, this)"
                                                class="w-10 h-10 {{ $post->is_pinned ? 'bg-gold-500 hover:bg-gold-600' : 'bg-gray-500 hover:bg-gray-600' }} rounded-full flex items-center justify-center text-white shadow-lg transition-colors"
                                                title="{{ $post->is_pinned ? 'إلغاء التثبيت' : 'تثبيت في الأعلى' }}">
                                                <i class="fas fa-thumbtack"></i>
                                            </button>
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
                            <div class="p-5 flex flex-col flex-grow">
                                <h3
                                    class="font-bold text-brown-700 text-lg mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                    <a href="{{ route('posts.show', $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                @if ($post->body)
                                    <p class="text-brown-500 text-sm line-clamp-3 mb-4 leading-relaxed">
                                        {{ Str::limit(strip_tags($post->body), 120) }}
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

    @push('scripts')
        <script>
            function togglePin(postId, btn) {
                fetch(`/admin/posts/${postId}/toggle-pin`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            if (data.is_pinned) {
                                btn.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                                btn.classList.add('bg-gold-500', 'hover:bg-gold-600');
                                btn.title = 'إلغاء التثبيت';
                            } else {
                                btn.classList.remove('bg-gold-500', 'hover:bg-gold-600');
                                btn.classList.add('bg-gray-500', 'hover:bg-gray-600');
                                btn.title = 'تثبيت في الأعلى';
                            }
                            showToast(data.message, 'success');
                            // إعادة تحميل الصفحة بعد ثانية لتحديث الترتيب
                            setTimeout(() => location.reload(), 1000);
                        }
                    })
                    .catch(err => console.error(err));
            }
        </script>
    @endpush
@endsection

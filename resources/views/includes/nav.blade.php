<!-- شريط التنقل - Mobile First -->
<nav x-data="{ open: false }" class="bg-primary-500 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- الشعار -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 rtl:space-x-reverse">
                    <div class="w-10 h-10 bg-gold-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-mosque text-primary-900 text-lg"></i>
                    </div>
                    <span class="text-white font-bold text-lg">رواق العلوم الشرعية</span>
                </a>
            </div>

            <!-- القائمة للشاشات الكبيرة -->
            <div class="hidden md:flex items-center space-x-1 rtl:space-x-reverse">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 text-white hover:bg-primary-600 rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <i class="fas fa-home"></i>
                    <span>الرئيسية</span>
                </a>

                @php
                    $sections = \App\Models\Section::all();
                @endphp

                @foreach ($sections as $section)
                    <a href="{{ route('posts.section', $section->id) }}"
                        class="px-4 py-2 text-white hover:bg-primary-600 rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <i class="fas {{ $section->icon }}"></i>
                        <span>{{ $section->name }}</span>
                    </a>
                @endforeach
            </div>

            <!-- أزرار المستخدم -->
            <div class="hidden md:flex items-center space-x-3 rtl:space-x-reverse">
                @auth
                    @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                        <a href="{{ route('admin.posts.create') }}"
                            class="bg-gold-500 text-primary-900 px-4 py-2 rounded-lg font-medium hover:bg-gold-400 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>إضافة منشور</span>
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="text-white hover:text-gold-300 transition-colors">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-gold-300 transition-colors px-3 py-2">
                        تسجيل الدخول
                    </a>
                @endauth
            </div>

            <!-- زر القائمة للموبايل -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-white p-2 rounded-lg hover:bg-primary-600 transition-colors">
                    <i x-show="!open" class="fas fa-bars text-xl"></i>
                    <i x-show="open" class="fas fa-times text-xl" style="display: none;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- القائمة المتجاوبة للموبايل -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-primary-600" style="display: none;">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}"
                class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors">
                <i class="fas fa-home ml-2"></i>
                الرئيسية
            </a>

            @foreach ($sections as $section)
                <a href="{{ route('posts.section', $section->id) }}"
                    class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors">
                    <i class="fas {{ $section->icon }} ml-2"></i>
                    {{ $section->name }}
                </a>
            @endforeach

            <hr class="border-primary-400 my-2">

            @auth
                @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                    <a href="{{ route('admin.posts.create') }}"
                        class="block px-4 py-3 bg-gold-500 text-primary-900 rounded-lg font-medium text-center">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة منشور
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors">
                    <i class="fas fa-user ml-2"></i>
                    الملف الشخصي
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors text-center">
                    تسجيل الدخول
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- البحث المباشر -->
<div class="bg-primary-600 py-3" x-data="liveSearch()">
    <div class="max-w-7xl mx-auto px-4">
        <div class="relative">
            <input type="text" x-model="query" @input.debounce.300ms="search()" @focus="showResults = true"
                @click.away="showResults = false" placeholder="ابحث في المقالات والكتب..."
                class="w-full py-3 px-5 pr-12 rounded-full bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/60">
                <i class="fas fa-search" x-show="!loading"></i>
                <i class="fas fa-spinner fa-spin" x-show="loading" style="display: none;"></i>
            </div>

            <!-- نتائج البحث -->
            <div x-show="showResults && results.length > 0" x-transition
                class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl overflow-hidden z-50"
                style="display: none;">
                <template x-for="post in results" :key="post.id">
                    <a :href="post.url"
                        class="flex items-center gap-4 p-4 hover:bg-cream-100 transition-colors border-b border-cream-200 last:border-0">
                        <div class="w-16 h-16 bg-cream-200 rounded-lg overflow-hidden flex-shrink-0">
                            <template x-if="post.image">
                                <img :src="post.image" :alt="post.title" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!post.image">
                                <div class="w-full h-full flex items-center justify-center bg-primary-100">
                                    <i class="fas fa-file-alt text-primary-400"></i>
                                </div>
                            </template>
                        </div>
                        <div class="flex-grow min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs bg-primary-100 text-primary-600 px-2 py-0.5 rounded-full"
                                    x-text="post.section"></span>
                            </div>
                            <h4 class="font-bold text-brown-700 truncate" x-text="post.title"></h4>
                            <p class="text-sm text-brown-400 line-clamp-1" x-text="post.excerpt"></p>
                        </div>
                        <i class="fas fa-chevron-left text-brown-300"></i>
                    </a>
                </template>
            </div>

            <!-- رسالة "لا توجد نتائج" -->
            <div x-show="showResults && query.length >= 2 && results.length === 0 && !loading"
                class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl p-6 text-center z-50"
                style="display: none;">
                <i class="fas fa-search text-4xl text-brown-300 mb-3"></i>
                <p class="text-brown-500">لا توجد نتائج للبحث عن "<span x-text="query"></span>"</p>
            </div>
        </div>
    </div>
</div>

<script>
    function liveSearch() {
        return {
            query: '',
            results: [],
            loading: false,
            showResults: false,

            async search() {
                if (this.query.length < 2) {
                    this.results = [];
                    return;
                }

                this.loading = true;

                try {
                    const response = await fetch(`/search?q=${encodeURIComponent(this.query)}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();

                    if (data.success) {
                        this.results = data.posts;
                        this.showResults = true;
                    }
                } catch (error) {
                    console.error('Search error:', error);
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>

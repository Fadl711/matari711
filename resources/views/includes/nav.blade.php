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
                    <span class="text-white font-bold text-sm md:text-base lg:text-lg">د.محمد بن جميل المطري</span>
                </a>
            </div>

            <!-- القائمة للشاشات الكبيرة -->
            <div class="hidden lg:flex items-center gap-0.5 xl:gap-2">
                <a href="{{ route('home') }}"
                    class="px-2 xl:px-4 py-2 text-sm xl:text-base text-white hover:bg-primary-600 rounded-lg transition-colors duration-200 flex items-center gap-1 xl:gap-2">
                    <i class="fas fa-home text-sm hidden xl:inline-block"></i>
                    <span>الرئيسية</span>
                </a>

                @php
                    $allNavSections = \App\Models\Section::whereNull('parent_id')
                        ->orderBy('sort_order')
                        ->with('children')
                        ->get();
                    $navSections = $allNavSections->take(4);
                    $extraSections = $allNavSections->slice(4);
                @endphp

                @foreach ($navSections as $navSection)
                    @if ($navSection->children->count() > 0)
                        <!-- قسم به أقسام فرعية -->
                        <div x-data="{ dropOpen: false }" @click.away="dropOpen = false" class="relative">
                            <div class="flex items-center">
                                <a href="{{ route('posts.section', $navSection->id) }}"
                                    class="px-2 xl:px-3 py-2 text-sm xl:text-base text-white hover:bg-primary-600 rounded-r-lg transition-colors duration-200 flex items-center gap-1 xl:gap-2">
                                    <i class="fas {{ $navSection->icon }} text-sm hidden xl:inline-block"></i>
                                    <span>{{ $navSection->name }}</span>
                                </a>
                                <button @click.prevent="dropOpen = !dropOpen"
                                    class="px-1.5 py-2 text-white hover:bg-primary-600 rounded-l-lg transition-colors duration-200">
                                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                                        :class="dropOpen ? 'rotate-180' : ''"></i>
                                </button>
                            </div>
                            <div x-show="dropOpen" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95" class="absolute top-full right-0 pt-1 z-50"
                                style="display: none;">
                                <div
                                    class="bg-white rounded-xl shadow-xl overflow-hidden min-w-[200px] border border-cream-200">
                                    <a href="{{ route('posts.section', $navSection->id) }}"
                                        class="block px-4 py-3 text-brown-700 hover:bg-primary-50 hover:text-primary-600 transition-colors border-b border-cream-100 font-bold text-sm">
                                        <i class="fas fa-th-large ml-2 text-primary-500"></i>
                                        عرض الكل
                                    </a>
                                    @foreach ($navSection->children as $child)
                                        <a href="{{ route('posts.section', $child->id) }}"
                                            class="block px-4 py-3 text-brown-600 hover:bg-primary-50 hover:text-primary-600 transition-colors text-sm border-b border-cream-50 last:border-0">
                                            <i class="fas {{ $child->icon }} ml-2 text-brown-300"></i>
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('posts.section', $navSection->id) }}"
                            class="px-2 xl:px-4 py-2 text-sm xl:text-base text-white hover:bg-primary-600 rounded-lg transition-colors duration-200 flex items-center gap-1 xl:gap-2">
                            <i class="fas {{ $navSection->icon }} text-sm hidden xl:inline-block"></i>
                            <span>{{ $navSection->name }}</span>
                        </a>
                    @endif
                @endforeach

                {{-- زر "المزيد" للأقسام الإضافية --}}
                @if ($extraSections->count() > 0)
                    <div x-data="{ moreOpen: false }" @click.away="moreOpen = false" class="relative">
                        <button @click="moreOpen = !moreOpen"
                            class="px-3 xl:px-4 py-2 text-sm xl:text-base text-gold-300 hover:bg-primary-600 rounded-lg transition-colors duration-200 flex items-center gap-1">
                            <i class="fas fa-ellipsis-h"></i>
                            <span>المزيد</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                                :class="moreOpen ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="moreOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full right-0 pt-1 z-50" style="display: none;">
                            <div
                                class="bg-white rounded-xl shadow-xl overflow-hidden min-w-[220px] border border-cream-200">
                                @foreach ($extraSections as $extra)
                                    <a href="{{ route('posts.section', $extra->id) }}"
                                        class="block px-4 py-3 text-brown-700 hover:bg-primary-50 hover:text-primary-600 transition-colors text-sm border-b border-cream-100 last:border-0 font-medium">
                                        <i class="fas {{ $extra->icon }} ml-2 text-primary-400"></i>
                                        {{ $extra->name }}
                                    </a>
                                    @foreach ($extra->children as $child)
                                        <a href="{{ route('posts.section', $child->id) }}"
                                            class="block px-8 py-2 text-brown-500 hover:bg-primary-50 hover:text-primary-600 transition-colors text-xs border-b border-cream-50 last:border-0">
                                            <i class="fas fa-angle-left ml-1"></i>
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <a href="{{ route('about') }}"
                    class="px-2 xl:px-4 py-2 text-sm xl:text-base text-white hover:bg-primary-600 rounded-lg transition-colors duration-200 flex items-center gap-1 xl:gap-2 whitespace-nowrap">
                    <i class="fas fa-user-graduate text-sm hidden xl:inline-block"></i>
                    <span>تعريف بالشيخ</span>
                </a>
            </div>

            <!-- أزرار المستخدم -->
            <div class="hidden lg:flex items-center space-x-3 rtl:space-x-reverse">
                @auth
                    @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                        <a href="{{ route('dashboard') }}"
                            class="bg-gold-500 text-primary-900 px-3 py-1.5 md:px-4 md:py-2 rounded-lg text-sm font-medium hover:bg-gold-400 transition-colors duration-200 flex items-center gap-1.5">
                            <i class="fas fa-tachometer-alt text-sm"></i>
                            <span class="hidden lg:inline">لوحة التحكم</span>
                            <span class="lg:hidden">لوحة</span>
                        </a>
                    @endif

                @endauth
            </div>

            <!-- زر القائمة للموبايل -->
            <div class="lg:hidden flex items-center">
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
        x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden bg-primary-600" style="display: none;">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}"
                class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors">
                <i class="fas fa-home ml-2"></i>
                الرئيسية
            </a>

            @foreach ($allNavSections as $navSection)
                @if ($navSection->children->count() > 0)
                    <!-- قسم رئيسي مع فرعية - accordion -->
                    <div x-data="{ subOpen: false }">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('posts.section', $navSection->id) }}"
                                class="flex-grow px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors font-bold">
                                <i class="fas {{ $navSection->icon }} ml-2"></i>
                                {{ $navSection->name }}
                            </a>
                            <button @click="subOpen = !subOpen"
                                class="px-4 py-3 text-white hover:bg-primary-700 rounded-lg">
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                                    :class="subOpen ? 'rotate-180' : ''"></i>
                            </button>
                        </div>
                        <div x-show="subOpen" x-transition class="pr-4" style="display: none;">
                            @foreach ($navSection->children as $child)
                                <a href="{{ route('posts.section', $child->id) }}"
                                    class="block px-8 py-2 text-white/80 hover:bg-primary-700 rounded-lg transition-colors text-sm">
                                    <i class="fas fa-angle-left ml-1"></i>
                                    {{ $child->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ route('posts.section', $navSection->id) }}"
                        class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors font-bold">
                        <i class="fas {{ $navSection->icon }} ml-2"></i>
                        {{ $navSection->name }}
                    </a>
                @endif
            @endforeach

            <a href="{{ route('about') }}"
                class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors">
                <i class="fas fa-user-graduate ml-2"></i>
                تعريف بالشيخ
            </a>

            <hr class="border-primary-400 my-2">

            @auth
                @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-3 bg-gold-500 text-primary-900 rounded-lg font-medium text-center">
                        <i class="fas fa-tachometer-alt ml-2"></i>
                        لوحة التحكم
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-3 text-white hover:bg-primary-700 rounded-lg transition-colors">
                    <i class="fas fa-user ml-2"></i>
                    الملف الشخصي
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

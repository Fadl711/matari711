<!-- التذييل -->
<footer class="bg-primary-800 text-white mt-auto">
    <!-- القسم العلوي -->
    <div class="max-w-7xl mx-auto px-4 py-8 lg:py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
            <!-- معلومات الموقع -->
            <div class="text-center md:text-right">
                <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                    <div class="w-12 h-12 bg-gold-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-mosque text-primary-900 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">د.محمد بن جميل المطري</h3>
                        <p class="text-primary-200 text-sm">موقع رسمي</p>
                    </div>
                </div>
                <p class="text-primary-200 text-sm leading-relaxed">
                    الموقع الرسمي للشيخ الدكتور محمد بن علي بن جميل المطري - كتب ومقالات وفتاوى ودروس صوتية ومرئية
                </p>
            </div>

            <!-- روابط سريعة -->
            <div class="text-center">
                <h4 class="text-lg font-bold mb-4 text-gold-400">روابط سريعة</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-primary-200 hover:text-gold-400 transition-colors">
                            الصفحة الرئيسية
                        </a>
                    </li>
                    @php
                        $footerSections = \App\Models\Section::whereNull('parent_id')
                            ->orderBy('sort_order')
                            ->take(4)
                            ->get();
                    @endphp
                    @foreach ($footerSections as $section)
                        <li>
                            <a href="{{ route('posts.section', $section->id) }}"
                                class="text-primary-200 hover:text-gold-400 transition-colors">
                                {{ $section->name }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('about') }}" class="text-primary-200 hover:text-gold-400 transition-colors">
                            تعريف بالشيخ
                        </a>
                    </li>
                </ul>
            </div>

            <!-- التواصل -->
            <div class="text-center md:text-right">
                <h4 class="text-base lg:text-lg font-bold mb-3 lg:mb-4 text-gold-400">تواصل معنا</h4>
                <div class="flex flex-wrap justify-center md:justify-start gap-2 lg:gap-3">
                    <a href="https://www.facebook.com/people/%D9%85%D8%AD%D9%85%D8%AF-%D8%A7%D9%84%D9%85%D8%B7%D8%B1%D9%8A-%D8%A3%D8%A8%D9%88-%D8%A7%D9%84%D8%AD%D8%A7%D8%B1%D8%AB/100001945734611/"
                        target="_blank"
                        class="w-10 h-10 lg:w-12 lg:h-12 bg-primary-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-facebook-f text-base lg:text-xl"></i>
                    </a>
                    <a href="https://wa.me/967777175927" target="_blank"
                        class="w-10 h-10 lg:w-12 lg:h-12 bg-primary-700 hover:bg-green-600 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-whatsapp text-base lg:text-xl"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCBK-wRq3_Xkp3K3Rl01FN3Q" target="_blank"
                        class="w-10 h-10 lg:w-12 lg:h-12 bg-primary-700 hover:bg-red-600 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-youtube text-base lg:text-xl"></i>
                    </a>
                    <a href="https://t.me/Matari63" target="_blank"
                        class="w-10 h-10 lg:w-12 lg:h-12 bg-primary-700 hover:bg-sky-500 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-telegram-plane text-base lg:text-xl"></i>
                    </a>
                </div>

                <!-- معلومات الاتصال -->
                <div class="mt-4 lg:mt-6 space-y-2 text-sm lg:text-base">
                    <a href="mailto:Matari63@Hotmail.com"
                        class="block text-primary-200 hover:text-gold-400 transition-colors break-all">
                        <i class="fas fa-envelope ml-2 text-sm"></i>
                        <span class="text-xs lg:text-sm">Matari63@Hotmail.com</span>
                    </a>
                    <a href="tel:+967777175927" class="block text-primary-200 hover:text-gold-400 transition-colors"
                        dir="ltr">
                        <i class="fas fa-phone ml-2 text-sm"></i>
                        <span class="text-xs lg:text-sm">+967 777 175 927</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- القسم السفلي -->
    <div class="bg-primary-900 py-4">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-primary-300 text-sm">
                © {{ date('Y') }} جميع الحقوق محفوظة - الشيخ الدكتور محمد المطري
            </p>
        </div>
    </div>
</footer>

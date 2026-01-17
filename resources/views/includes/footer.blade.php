<!-- التذييل -->
<footer class="bg-primary-800 text-white mt-auto">
    <!-- القسم العلوي -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- معلومات الموقع -->
            <div class="text-center md:text-right">
                <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                    <div class="w-12 h-12 bg-gold-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-mosque text-primary-900 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">رواق العلوم الشرعية</h3>
                        <p class="text-primary-200 text-sm">د. محمد بن علي بن جميل المطري</p>
                    </div>
                </div>
                <p class="text-primary-200 text-sm leading-relaxed">
                    منصة علمية شرعية لنشر العلم النافع من مقالات وكتب وفتاوى ودروس صوتية ومرئية
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
                        $footerSections = \App\Models\Section::take(4)->get();
                    @endphp
                    @foreach($footerSections as $section)
                        <li>
                            <a href="{{ route('posts.section', $section->id) }}" 
                               class="text-primary-200 hover:text-gold-400 transition-colors">
                                {{ $section->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- التواصل الاجتماعي -->
            <div class="text-center md:text-left">
                <h4 class="text-lg font-bold mb-4 text-gold-400">تواصل معنا</h4>
                <div class="flex justify-center md:justify-start gap-4">
                    <a href="https://www.facebook.com/people/%D9%85%D8%AD%D9%85%D8%AF-%D8%A7%D9%84%D9%85%D8%B7%D8%B1%D9%8A-%D8%A3%D8%A8%D9%88-%D8%A7%D9%84%D8%AD%D8%A7%D8%B1%D8%AB/100001945734611/" 
                       target="_blank"
                       class="w-12 h-12 bg-primary-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" 
                       class="w-12 h-12 bg-primary-700 hover:bg-green-600 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="#" 
                       class="w-12 h-12 bg-primary-700 hover:bg-sky-500 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-telegram text-xl"></i>
                    </a>
                    <a href="#" 
                       class="w-12 h-12 bg-primary-700 hover:bg-red-600 rounded-full flex items-center justify-center transition-colors">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
                
                <!-- البريد الإلكتروني -->
                <div class="mt-6">
                    <a href="mailto:info@example.com" class="text-primary-200 hover:text-gold-400 transition-colors">
                        <i class="fas fa-envelope ml-2"></i>
                        info@rawaq-aloloom.com
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- القسم السفلي -->
    <div class="bg-primary-900 py-4">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-primary-300 text-sm">
                © {{ date('Y') }} جميع الحقوق محفوظة - رواق العلوم الشرعية
            </p>
        </div>
    </div>
</footer>

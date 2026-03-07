@extends('layout')

@section('title', 'تعريف بالشيخ - د.محمد بن جميل المطري')

@section('content')
    <!-- Hero Section - Islamic Classic -->
    <section class="relative overflow-hidden text-white"
        style="background: linear-gradient(135deg, #1a4731 0%, #0d3322 40%, #1a4731 100%); min-height: 420px;">

        <!-- زخارف هندسية إسلامية - الخلفية -->
        <div class="absolute inset-0 opacity-[0.07]">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <defs>
                    <pattern id="islamicPattern" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse">
                        <!-- نجمة ثمانية الأضلاع -->
                        <polygon points="60,5 72,35 105,35 80,55 90,88 60,70 30,88 40,55 15,35 48,35" fill="none"
                            stroke="#c9a55b" stroke-width="1.2" />
                        <polygon points="60,20 68,42 92,42 73,56 80,80 60,66 40,80 47,56 28,42 52,42" fill="none"
                            stroke="#c9a55b" stroke-width="0.6" />
                        <!-- خطوط زخرفية -->
                        <line x1="0" y1="60" x2="120" y2="60" stroke="#c9a55b"
                            stroke-width="0.4" stroke-dasharray="4,8" />
                        <line x1="60" y1="0" x2="60" y2="120" stroke="#c9a55b"
                            stroke-width="0.4" stroke-dasharray="4,8" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#islamicPattern)" />
            </svg>
        </div>

        <!-- إطار ذهبي علوي وسفلي -->
        <div class="absolute top-0 left-0 right-0 h-1"
            style="background: linear-gradient(90deg, transparent, #c9a55b, #f0d080, #c9a55b, transparent);"></div>
        <div class="absolute bottom-0 left-0 right-0 h-1"
            style="background: linear-gradient(90deg, transparent, #c9a55b, #f0d080, #c9a55b, transparent);"></div>

        <!-- هلال ونجوم - يمين -->
        <div class="absolute top-6 right-6 opacity-60">
            <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- الهلال -->
                <path d="M55 15 C35 20, 22 38, 28 58 C34 78, 55 88, 72 80 C52 82, 36 68, 32 50 C28 32, 38 16, 55 15Z"
                    fill="#c9a55b" />
                <!-- نجمة كبيرة -->
                <polygon points="75,10 77.5,17 85,17 79,21.5 81.5,29 75,24.5 68.5,29 71,21.5 65,17 72.5,17"
                    fill="#f0d080" />
                <!-- نجمة صغيرة -->
                <polygon points="82,38 83.2,41.5 87,41.5 84,43.5 85.2,47 82,45 78.8,47 80,43.5 77,41.5 80.8,41.5"
                    fill="#c9a55b" />
                <!-- نجمة أصغر -->
                <polygon points="60,5 61,8 64,8 61.5,9.8 62.5,13 60,11.2 57.5,13 58.5,9.8 56,8 59,8" fill="#c9a55b"
                    opacity="0.8" />
            </svg>
        </div>

        <!-- هلال ونجوم - يسار (معكوس) -->
        <div class="absolute top-6 left-6 opacity-60" style="transform: scaleX(-1);">
            <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- الهلال -->
                <path d="M55 15 C35 20, 22 38, 28 58 C34 78, 55 88, 72 80 C52 82, 36 68, 32 50 C28 32, 38 16, 55 15Z"
                    fill="#c9a55b" />
                <!-- نجمة كبيرة -->
                <polygon points="75,10 77.5,17 85,17 79,21.5 81.5,29 75,24.5 68.5,29 71,21.5 65,17 72.5,17"
                    fill="#f0d080" />
                <!-- نجمة صغيرة -->
                <polygon points="82,38 83.2,41.5 87,41.5 84,43.5 85.2,47 82,45 78.8,47 80,43.5 77,41.5 80.8,41.5"
                    fill="#c9a55b" />
                <!-- نجمة أصغر -->
                <polygon points="60,5 61,8 64,8 61.5,9.8 62.5,13 60,11.2 57.5,13 58.5,9.8 56,8 59,8" fill="#c9a55b"
                    opacity="0.8" />
            </svg>
        </div>

        <!-- نجوم متناثرة في الخلفية -->
        <div class="absolute bottom-8 right-16 opacity-30">
            <svg width="16" height="16" viewBox="0 0 24 24">
                <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9" fill="#f0d080" />
            </svg>
        </div>
        <div class="absolute bottom-16 right-1/3 opacity-20">
            <svg width="10" height="10" viewBox="0 0 24 24">
                <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9" fill="#f0d080" />
            </svg>
        </div>
        <div class="absolute bottom-8 left-16 opacity-30">
            <svg width="14" height="14" viewBox="0 0 24 24">
                <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9" fill="#f0d080" />
            </svg>
        </div>
        <div class="absolute top-1/2 right-12 opacity-20">
            <svg width="8" height="8" viewBox="0 0 24 24">
                <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9" fill="#c9a55b" />
            </svg>
        </div>
        <div class="absolute top-1/2 left-12 opacity-20">
            <svg width="8" height="8" viewBox="0 0 24 24">
                <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9" fill="#c9a55b" />
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10 py-14 md:py-20">
            <div class="max-w-4xl mx-auto">

                <!-- صورة الشيخ بالإطار الإسلامي الكلاسيكي -->
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <!-- هالة خارجية ذهبية مضيئة -->
                        <div class="absolute inset-0 rounded-full blur-2xl opacity-50"
                            style="background: radial-gradient(circle, #c9a55b 0%, transparent 70%); transform: scale(1.5);">
                        </div>

                        <!-- إطار مثمن خارجي -->
                        <div class="relative flex items-center justify-center" style="width: 270px; height: 270px;">
                            <!-- دائرة ذهبية خارجية متحركة -->
                            <div class="absolute inset-0 rounded-full border-2 border-dashed opacity-60 animate-spin"
                                style="border-color: #c9a55b; animation-duration: 20s;"></div>
                            <!-- دائرة ذهبية وسطى -->
                            <div class="absolute rounded-full border-4"
                                style="inset: 10px; border-color: #c9a55b; box-shadow: 0 0 25px rgba(201,165,91,0.4), inset 0 0 25px rgba(201,165,91,0.1);">
                            </div>
                            <!-- الصورة -->
                            <img src="{{ asset('sheikh-photo2.webp') }}" alt="الشيخ الدكتور محمد المطري"
                                class="rounded-full object-cover border-4 border-white/10 shadow-2xl"
                                style="width: 220px; height: 220px; object-position: top; position: relative; z-index: 10;">
                            <!-- نجوم الأركان الأربعة -->
                            <div class="absolute" style="top:-10px; left:50%; transform:translateX(-50%);">
                                <svg width="22" height="22" viewBox="0 0 24 24">
                                    <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9"
                                        fill="#c9a55b" />
                                </svg>
                            </div>
                            <div class="absolute" style="bottom:-10px; left:50%; transform:translateX(-50%);">
                                <svg width="22" height="22" viewBox="0 0 24 24">
                                    <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9"
                                        fill="#c9a55b" />
                                </svg>
                            </div>
                            <div class="absolute" style="right:-10px; top:50%; transform:translateY(-50%);">
                                <svg width="22" height="22" viewBox="0 0 24 24">
                                    <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9"
                                        fill="#c9a55b" />
                                </svg>
                            </div>
                            <div class="absolute" style="left:-10px; top:50%; transform:translateY(-50%);">
                                <svg width="22" height="22" viewBox="0 0 24 24">
                                    <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9"
                                        fill="#c9a55b" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- العنوان بزخرفة إسلامية -->
                <div class="text-center">
                    <!-- خط زخرفي علوي -->
                    <div class="flex items-center justify-center gap-3 mb-4">
                        <div class="h-px flex-1 max-w-[80px]"
                            style="background: linear-gradient(90deg, transparent, #c9a55b);"></div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <polygon points="12,2 14.5,9 22,9 16,14 18.5,21 12,17 5.5,21 8,14 2,9 9.5,9" fill="#c9a55b" />
                        </svg>
                        <div class="h-px flex-1 max-w-[80px]"
                            style="background: linear-gradient(90deg, #c9a55b, transparent);"></div>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-bold mb-3"
                        style="font-family: 'Amiri', 'Scheherazade New', serif; text-shadow: 0 2px 15px rgba(0,0,0,0.3);">
                        تعريف بالشيخ</h1>

                    <!-- خط فاصل ذهبي -->
                    <div class="flex items-center justify-center gap-3 my-4">
                        <div class="h-px flex-1 max-w-[120px]"
                            style="background: linear-gradient(90deg, transparent, #c9a55b);"></div>
                        <div class="flex gap-1">
                            <div class="w-1.5 h-1.5 rounded-full" style="background: #c9a55b;"></div>
                            <div class="w-2.5 h-2.5 rounded-full" style="background: #f0d080;"></div>
                            <div class="w-1.5 h-1.5 rounded-full" style="background: #c9a55b;"></div>
                        </div>
                        <div class="h-px flex-1 max-w-[120px]"
                            style="background: linear-gradient(90deg, #c9a55b, transparent);"></div>
                    </div>

                    <h2 class="text-2xl md:text-3xl font-semibold mb-2"
                        style="color: #f0d080; text-shadow: 0 1px 8px rgba(0,0,0,0.3);">
                        محمد بن علي بن جميل المطري
                    </h2>
                    <p class="text-lg" style="color: #a8cdb8;">
                        دكتوراه في التفسير وعلوم القرآن الكريم
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- Main Content -->
    <section class="py-12 md:py-16 bg-cream-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">

                <!-- Personal Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-user-circle text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">نبذة شخصية</h3>
                    </div>
                    <div class="prose prose-lg max-w-none text-brown-600">
                        <p class="text-lg leading-relaxed">
                            من مواليد صنعاء - اليمن عام <span class="font-semibold text-primary-700">1398هـ</span> الموافق
                            <span class="font-semibold">1978م</span>.
                        </p>
                    </div>
                </div>

                <!-- Academic Qualifications -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-graduation-cap text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">المؤهلات العلمية</h3>
                    </div>
                    <div class="space-y-6">
                        <!-- PhD -->
                        <div class="border-r-4 border-primary-500 pr-4">
                            <h4 class="text-xl font-semibold text-brown-700 mb-2">
                                <i class="fas fa-certificate text-gold-500 ml-2"></i>
                                الدكتوراه
                            </h4>
                            <p class="text-brown-600 leading-relaxed">
                                دكتوراه في <strong>التفسير وعلوم القرآن الكريم</strong> من جامعة المدينة العالمية بماليزيا،
                                عام 1443هـ - 2021م.
                            </p>
                            <p class="text-brown-600 mt-2 pr-4">
                                رسالة الدكتوراه: جزء من <strong class="text-primary-700">(الموسوعة العالمية في الهدايات
                                    القرآنية)</strong>، وهو مشروع كبير بإشراف جامعة أم القرى بمكة المكرمة، بمشاركة 60 باحثًا
                                من عدة دول إسلامية.
                            </p>
                        </div>

                        <!-- Master's -->
                        <div class="border-r-4 border-primary-400 pr-4">
                            <h4 class="text-xl font-semibold text-brown-700 mb-2">
                                <i class="fas fa-award text-gold-500 ml-2"></i>
                                الماجستير
                            </h4>
                            <p class="text-brown-600 leading-relaxed">
                                ماجستير من جامعة الأندلس بصنعاء - دراسات إسلامية تخصص تفسير في عام 1438هـ - 2017م.
                            </p>
                            <p class="text-brown-600 mt-2 pr-4">
                                موضوع الرسالة: <strong class="text-primary-700">(الخطأ في نِسبة الأقوال في كتب
                                    التفسير)</strong>.
                            </p>
                        </div>

                        <!-- Other Programs -->
                        <div class="border-r-4 border-primary-300 pr-4">
                            <h4 class="text-xl font-semibold text-brown-700 mb-2">
                                <i class="fas fa-star text-gold-500 ml-2"></i>
                                برامج أخرى
                            </h4>
                            <p class="text-brown-600 leading-relaxed">
                                خِرِّيج برنامج رعاية الموهوبين في صنعاء عام 1432هـ بعد دراسة مكثَّفة لمدة ثلاثة أعوام.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Scholarly Foundation -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-book-quran text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">الأساس العلمي</h3>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-cream-50 rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-quran text-2xl text-primary-600"></i>
                                <h4 class="font-bold text-brown-700">الحفظ والإتقان</h4>
                            </div>
                            <ul class="space-y-2 text-brown-600">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-primary-500 mt-1"></i>
                                    <span>حفظ القرآن الكريم</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-primary-500 mt-1"></i>
                                    <span>حفظ متون متنوعة في التوحيد والعقيدة والفقه وأصول الفقه والنحو وعلوم الحديث</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-cream-50 rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-certificate text-2xl text-primary-600"></i>
                                <h4 class="font-bold text-brown-700">الإجازات العلمية</h4>
                            </div>
                            <ul class="space-y-2 text-brown-600">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-primary-500 mt-1"></i>
                                    <span>أكثر من 10 إجازات في القرآن الكريم بعدة روايات</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-primary-500 mt-1"></i>
                                    <span>إجازات علمية عامة من كثير من العلماء</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-primary-500 mt-1"></i>
                                    <span>عدة شهادات في دورات تدريبية متنوعة</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6 bg-primary-50 rounded-xl p-5 border-r-4 border-primary-500">
                        <h4 class="font-bold text-brown-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-book-open text-primary-600"></i>
                            القراءة والاطلاع
                        </h4>
                        <p class="text-brown-600 leading-relaxed mb-3">
                            قراءة كثير من الكتب المتنوعة، ومن المطوَّلات:
                        </p>
                        <ul class="space-y-2 text-brown-600 pr-4">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-angle-left text-primary-500 mt-1"></i>
                                <span>تفسير ابن جرير الطبري</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-angle-left text-primary-500 mt-1"></i>
                                <span>فتح الباري بشرح صحيح البخاري لابن حجر</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-angle-left text-primary-500 mt-1"></i>
                                <span>التمهيد لابن عبد البر</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-angle-left text-primary-500 mt-1"></i>
                                <span>غيرها من كتب المتقدمين والمتأخرين</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Specializations -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-layer-group text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">التخصصات</h3>
                    </div>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl p-4 text-center">
                            <i class="fas fa-book text-3xl text-primary-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">التفسير وعلوم القرآن</p>
                        </div>
                        <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl p-4 text-center">
                            <i class="fas fa-scroll text-3xl text-primary-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">الحديث النبوي رواية ودراية</p>
                        </div>
                        <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl p-4 text-center">
                            <i class="fas fa-balance-scale text-3xl text-primary-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">الفقه المقارن</p>
                        </div>
                        <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl p-4 text-center">
                            <i class="fas fa-kaaba text-3xl text-primary-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">العقيدة</p>
                        </div>
                    </div>
                </div>

                <!-- Teaching & Da'wah Activities -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-chalkboard-teacher text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">الجهود التعليمية والدعوية</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Teaching -->
                        <div>
                            <h4 class="font-bold text-lg text-brown-700 mb-3 flex items-center gap-2">
                                <i class="fas fa-mosque text-primary-600"></i>
                                التدريس في المساجد والمراكز العلمية
                            </h4>
                            <p class="text-brown-600 mb-3">
                                قام بالتدريس في كثير من المساجد والمراكز العلمية في صنعاء وغيرها، ومما درَّسَه:
                            </p>
                            <div class="grid md:grid-cols-2 gap-3">
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>تفسير القرآن الكريم أكثر من مرة</span>
                                </div>
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>علوم القرآن والتجويد</span>
                                </div>
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>الحديث النبوي متنًا وإسنادًا</span>
                                </div>
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>مصطلح الحديث</span>
                                </div>
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>النحو وأصول الفقه</span>
                                </div>
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>الفقه الشافعي والفقه المقارن</span>
                                </div>
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>التوحيد والعقيدة</span>
                                </div>
                                <div class="flex items-start gap-2 text-brown-600">
                                    <i class="fas fa-angle-double-left text-primary-500 mt-1"></i>
                                    <span>التاريخ والأدب</span>
                                </div>
                            </div>
                        </div>

                        <!-- Imamate & Khutbah -->
                        <div class="bg-cream-50 rounded-xl p-5">
                            <h4 class="font-bold text-lg text-brown-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-microphone text-primary-600"></i>
                                الإمامة والخطابة
                            </h4>
                            <p class="text-brown-600">قام بالإمامة والخطابة في عدة مساجد في العاصمة صنعاء وضواحيها.</p>
                        </div>

                        <!-- Da'wah Programs -->
                        <div class="bg-cream-50 rounded-xl p-5">
                            <h4 class="font-bold text-lg text-brown-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-users text-primary-600"></i>
                                الدورات العلمية والرحلات الدعوية
                            </h4>
                            <p class="text-brown-600 mb-3">قام بعدة دورات علمية ورحلات دعوية في:</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm">صنعاء
                                    وضواحيها</span>
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm">الحديدة</span>
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm">حضرموت</span>
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm">يافع</span>
                                <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm">شبوة</span>
                            </div>
                        </div>

                        <!-- International Da'wah -->
                        <div class="bg-cream-50 rounded-xl p-5">
                            <h4 class="font-bold text-lg text-brown-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-globe-africa text-primary-600"></i>
                                الجهود الدعوية الدولية
                            </h4>
                            <p class="text-brown-600">سافر إلى دولة بوروندي في شرق أفريقيا وإلى دولة توغو في غرب أفريقيا
                                للإشراف على الدعاة.</p>
                        </div>
                    </div>
                </div>

                <!-- Professional Experience -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-briefcase text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">الخبرات العملية</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="border-r-4 border-primary-500 pr-4">
                            <p class="text-brown-600"><i class="fas fa-check-circle text-primary-600 ml-2"></i>
                                مراجعة كثير من المحاضرات المفرَّغة والدروس المنشورة في موقع الشبكة الإسلامية <strong>إسلام
                                    ويب</strong>
                            </p>
                        </div>
                        <div class="border-r-4 border-primary-500 pr-4">
                            <p class="text-brown-600"><i class="fas fa-check-circle text-primary-600 ml-2"></i>
                                عمل مراقبًا شرعيًا في <strong>قناة يُسر الفضائية</strong>، ومسئولًا عن مركز الفتوى في القناة
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Publications & Contributions -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-pen-fancy text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">المساهمات العلمية والمؤلفات</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-primary-50 rounded-xl p-5 border-r-4 border-primary-600">
                            <h4 class="font-bold text-brown-700 mb-2">
                                <i class="fas fa-book-open text-primary-600 ml-2"></i>
                                التفسير المحرر
                            </h4>
                            <p class="text-brown-600">
                                شارك في تأليف <strong>التفسير المحرر</strong> (44 مجلدًا)، الصادر عن <strong>مؤسسة الدرر
                                    السَّنية</strong>
                            </p>
                        </div>

                        <div class="bg-primary-50 rounded-xl p-5 border-r-4 border-primary-600">
                            <h4 class="font-bold text-brown-700 mb-2">
                                <i class="fas fa-book text-primary-600 ml-2"></i>
                                الموسوعة العقدية
                            </h4>
                            <p class="text-brown-600">
                                شارك في تأليف <strong>الموسوعة العقدية</strong> الخاصة بموقع مؤسسة الدرر السَّنية
                            </p>
                        </div>

                        <div class="bg-gold-50 rounded-xl p-5 border-r-4 border-gold-500">
                            <h4 class="font-bold text-brown-700 mb-2">
                                <i class="fas fa-newspaper text-gold-600 ml-2"></i>
                                المقالات والبحوث
                            </h4>
                            <p class="text-brown-600">
                                نُشِر له في <strong>شبكة الألوكة</strong> أكثر من <span
                                    class="font-bold text-primary-700">300 كتاب ورسالة ومقالة</span>، بالإضافة إلى كتب
                                وبحوث كثيرة متنوعة
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Digital Presence -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-share-alt text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">النشاطات العلمية والدعوية الرقمية</h3>
                    </div>
                    <p class="text-brown-600 mb-4">
                        له نشاطات علمية ودعوية على منصات التواصل الاجتماعي:
                    </p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="https://www.youtube.com/channel/UCBK-wRq3_Xkp3K3Rl01FN3Q" target="_blank"
                            class="bg-red-50 rounded-xl p-4 text-center hover:bg-red-100 transition-colors">
                            <i class="fab fa-youtube text-4xl text-red-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">يوتيوب</p>
                        </a>
                        <a href="https://www.facebook.com/people/%D9%85%D8%AD%D9%85%D8%AF-%D8%A7%D9%84%D9%85%D8%B7%D8%B1%D9%8I-%D8%A3%D8%A8%D9%88-%D8%A7%D9%84%D8%AD%D8%A7%D8%B1%D8%AB/100001945734611/"
                            target="_blank"
                            class="bg-blue-50 rounded-xl p-4 text-center hover:bg-blue-100 transition-colors">
                            <i class="fab fa-facebook text-4xl text-blue-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">فيسبوك</p>
                        </a>
                        <a href="https://t.me/Matari63" target="_blank"
                            class="bg-sky-50 rounded-xl p-4 text-center hover:bg-sky-100 transition-colors">
                            <i class="fab fa-telegram text-4xl text-sky-500 mb-2"></i>
                            <p class="font-semibold text-brown-700 text-sm">تيليجرام</p>
                            <p class="text-xs text-sky-600 mt-1">@Matari63</p>
                        </a>
                        <a href="https://wa.me/967777175927" target="_blank"
                            class="bg-green-50 rounded-xl p-4 text-center hover:bg-green-100 transition-colors">
                            <i class="fab fa-whatsapp text-4xl text-green-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">واتساب</p>
                        </a>
                    </div>
                </div>

                <!-- Methodology -->
                <div
                    class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl shadow-lg p-6 md:p-8 mb-8 text-white">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-flag text-3xl text-gold-400"></i>
                        <h3 class="text-2xl font-bold">المنهج والدعوة</h3>
                    </div>
                    <p class="text-lg leading-relaxed text-cream-100">
                        لا ينتمي إلى أي حزب أو تنظيم، ودعوته إلى <strong class="text-gold-300">كتاب الله وسنة رسوله واتباع
                            سبيل الصحابة</strong>.
                    </p>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-address-card text-3xl text-primary-600"></i>
                        <h3 class="text-2xl font-bold text-brown-700">معلومات التواصل</h3>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-green-50 rounded-xl p-5 border-r-4 border-green-500">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fas fa-phone text-2xl text-green-600"></i>
                                <h4 class="font-bold text-brown-700">الهاتف والواتس</h4>
                            </div>
                            <a href="tel:+967777175927"
                                class="text-lg text-primary-700 hover:text-primary-800 font-semibold" dir="ltr">
                                +967 777 175 927
                            </a>
                        </div>

                        <div class="bg-blue-50 rounded-xl p-5 border-r-4 border-blue-500">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fas fa-envelope text-2xl text-blue-600"></i>
                                <h4 class="font-bold text-brown-700">البريد الإلكتروني</h4>
                            </div>
                            <a href="mailto:Matari63@Hotmail.com"
                                class="text-lg text-primary-700 hover:text-primary-800 font-semibold break-all">
                                Matari63@Hotmail.com
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

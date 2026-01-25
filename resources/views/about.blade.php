@extends('layout')

@section('title', 'عن الشيخ - د. محمد المطري')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-primary-700 to-primary-600 text-white py-16 md:py-24">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-pattern"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-6">
                    <i class="fas fa-mosque text-6xl md:text-7xl text-gold-400 opacity-90"></i>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">عن الشيخ</h1>
                <div class="h-1 w-24 bg-gold-400 mx-auto mb-6"></div>
                <h2 class="text-2xl md:text-3xl font-semibold text-cream-100">
                    محمد بن علي بن جميل المطري
                </h2>
                <p class="mt-4 text-lg text-cream-200">
                    دكتور في التفسير وعلوم القرآن الكريم
                </p>
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
                        <div class="bg-red-50 rounded-xl p-4 text-center">
                            <i class="fab fa-youtube text-4xl text-red-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">يوتيوب</p>
                        </div>
                        <div class="bg-blue-50 rounded-xl p-4 text-center">
                            <i class="fab fa-facebook text-4xl text-blue-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">فيسبوك</p>
                        </div>
                        <div class="bg-sky-50 rounded-xl p-4 text-center">
                            <i class="fab fa-telegram text-4xl text-sky-500 mb-2"></i>
                            <p class="font-semibold text-brown-700">تيليجرام</p>
                        </div>
                        <div class="bg-green-50 rounded-xl p-4 text-center">
                            <i class="fab fa-whatsapp text-4xl text-green-600 mb-2"></i>
                            <p class="font-semibold text-brown-700">واتساب</p>
                        </div>
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

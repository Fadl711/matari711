<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Primary Meta Tags -->
    <title>@yield('title', 'الشيخ الدكتور محمد المطري - موقع رسمي للعلوم الشرعية')</title>
    <meta name="title" content="@yield('meta_title', 'الشيخ الدكتور محمد المطري - موقع رسمي للعلوم الشرعية')">
    <meta name="description" content="@yield('meta_description', 'الموقع الرسمي للشيخ الدكتور محمد بن علي بن جميل المطري - متخصص في التفسير وعلوم القرآن - فتاوى ودروس ومقالات إسلامية')">
    <meta name="keywords" content="@yield('meta_keywords', 'محمد المطري، الشيخ المطري، دكتور محمد المطري، التفسير، علوم القرآن، الفقه، العقيدة، فتاوى إسلامية، دروس دينية، محاضرات إسلامية، كتب إسلامية')">
    <meta name="author" content="الشيخ الدكتور محمد بن علي بن جميل المطري">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'الشيخ الدكتور محمد المطري')">
    <meta property="og:description" content="@yield('og_description', 'الموقع الرسمي للشيخ الدكتور محمد المطري - علوم شرعية وفتاوى دينية')">
    <meta property="og:image" content="@yield('og_image', asset('R.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="ar_SA">
    <meta property="og:site_name" content="موقع الشيخ محمد المطري">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'الشيخ الدكتور محمد المطري')">
    <meta name="twitter:description" content="@yield('twitter_description', 'موقع رسمي للعلوم الشرعية والفتاوى الدينية')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('R.png'))">

    <!-- Additional SEO -->
    <meta name="language" content="Arabic">
    <meta name="geo.region" content="YE">
    <meta name="geo.placename" content="Yemen">
    <meta name="theme-color" content="#0d6f5a">
    <link rel="alternate" hreflang="ar" href="{{ url()->current() }}">

    <!-- خطوط عربية -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Tajawal:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2280%22>🕌</text></svg>">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "محمد بن علي بن جميل المطري",
        "jobTitle": "دكتور في التفسير وعلوم القرآن",
        "url": "{{ url('/') }}",
        "email": "Matari63@Hotmail.com",
        "telephone": "+967777175927",
        "sameAs": [
            "https://www.facebook.com/people/%D9%85%D8%AD%D9%85%D8%AF-%D8%A7%D9%84%D9%85%D8%B7%D8%B1%D9%8A-%D8%A3%D8%A8%D9%88-%D8%A7%D9%84%D8%AD%D8%A7%D8%B1%D8%AB/100001945734611/",
            "https://wa.me/967777175927"
        ],
        "alumniOf": {
            "@type": "Organization",
            "name": "جامعة المدينة العالمية بماليزيا"
        },
        "knowsAbout": ["التفسير", "علوم القرآن", "الفقه الإسلامي", "العقيدة", "الحديث النبوي"]
    }
    </script>


    <style>
        /* أنماط مخصصة */
        .font-arabic {
            font-family: 'Amiri', serif;
        }

        /* تأثير التمرير السلس */
        html {
            scroll-behavior: smooth;
        }

        /* أنماط البطاقات */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* نمط إسلامي للحدود */
        .islamic-border {
            border-image: linear-gradient(45deg, #0d6f5a, #d4af37) 1;
        }

        /* خلفية متدرجة إسلامية */
        .islamic-gradient {
            background: linear-gradient(135deg, #0d6f5a 0%, #094d3f 50%, #073d32 100%);
        }

        /* تأثير اللمعان الذهبي */
        .gold-shimmer {
            background: linear-gradient(90deg, #d4af37, #f0d77a, #d4af37);
            background-size: 200% auto;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to {
                background-position: 200% center;
            }
        }
    </style>

    <!-- SweetAlert2 & Toastify -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        // دالة لعرض التنبيهات (Toasts)
        function showToast(message, type = 'success') {
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "left",
                stopOnFocus: true,
                style: {
                    background: type === 'success' ? "linear-gradient(135deg, #10b981 0%, #059669 100%)" :
                        "#dc2626",
                    borderRadius: "12px",
                    fontFamily: "Tajawal, sans-serif",
                    fontSize: "16px",
                    fontWeight: "600",
                    boxShadow: "0 10px 25px -5px rgba(16, 185, 129, 0.5)"
                },
            }).showToast();
        }

        // تحويل التاريخ لميلادي وهجري
        function formatFullDate(dateStr) {
            if (!dateStr) return '';
            try {
                const date = new Date(dateStr);

                // التاريخ الهجري - محاولة استخدام تقويم أم القرى كأول خيار
                let hijriDate;
                const hijriOptions = {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };

                try {
                    // المحاولة الأولى: أم القرى (الأكثر دقة للسعودية)
                    const f1 = new Intl.DateTimeFormat('ar-SA-u-ca-islamic-umalqura', hijriOptions);
                    hijriDate = f1.format(date);
                    // فحص إذا كان المتصفح رجع شهور ميلادية (مثل يناير)
                    if (hijriDate.includes('يناير') || hijriDate.includes('ديسمبر') || hijriDate.includes('مارس')) throw 1;
                } catch (e) {
                    try {
                        // المحاولة الثانية: التقويم الإسلامي العام
                        const f2 = new Intl.DateTimeFormat('ar-u-ca-islamic', hijriOptions);
                        hijriDate = f2.format(date);
                        if (hijriDate.includes('يناير') || hijriDate.includes('ديسمبر')) throw 1;
                    } catch (e2) {
                        try {
                            // المحاولة الثالثة: التقويم الإسلامي المدني
                            const f3 = new Intl.DateTimeFormat('ar-u-ca-islamic-civil', hijriOptions);
                            hijriDate = f3.format(date);
                        } catch (e3) {
                            hijriDate = "تعذر حساب الهجري";
                        }
                    }
                }

                // التاريخ الميلادي
                const gregorianFormatter = new Intl.DateTimeFormat('ar-SA', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                const gregorianDate = gregorianFormatter.format(date);

                return `${hijriDate}  - الموافق ${gregorianDate} م`;
            } catch (e) {
                return '';
            }
        }
    </script>

    <!-- Plyr (مشغل الوسائط الاحترافي) -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <style>
        /* تخصيص ألوان Plyr لتناسب الموقع */
        :root {
            --plyr-color-main: #0d6f5a;
            /* اللون الأخضر الأساسي */
        }

        .plyr--audio .plyr__controls {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-cream-100 font-sans text-brown-700 min-h-screen flex flex-col">
    <!-- شريط التنقل -->
    @include('includes.nav')

    <!-- المحتوى الرئيسي -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- التذييل -->
    @include('includes.footer')

    <!-- سكربتات -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>

    <script>
        // تفعيل مشغل Plyr تلقائياً لجميع الفيديو والصوت
        document.addEventListener('DOMContentLoaded', () => {
            const players = Plyr.setup('video, audio', {
                controls: [
                    'play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions',
                    'settings', 'pip', 'airplay', 'fullscreen'
                ],
                settings: ['caption', 'quality', 'speed', 'loop'],
                speed: {
                    selected: 1,
                    options: [0.5, 0.75, 1, 1.25, 1.5, 2]
                },
                i18n: {
                    speed: 'السرعة',
                    normal: 'عادية',
                }
            });
        });

        // عرض رسائل سيسن لارافل
        @if (session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif
        @if (session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    </script>

    @stack('scripts')
</body>

</html>

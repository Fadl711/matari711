<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="رواق العلوم الشرعية - د. محمد بن علي بن جميل المطري">

    <!-- خطوط عربية -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Tajawal:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'رواق العلوم الشرعية')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2280%22>🕌</text></svg>">

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
                    background: type === 'success' ? "#0d6f5a" : "#dc2626",
                    borderRadius: "12px",
                    fontFamily: "Tajawal, sans-serif",
                    boxShadow: "0 10px 15px -3px rgba(0, 0, 0, 0.1)"
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

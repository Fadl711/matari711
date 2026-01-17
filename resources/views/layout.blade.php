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
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <title>@yield('title', 'رواق العلوم الشرعية')</title>
    
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
    
    @stack('scripts')
</body>
</html>

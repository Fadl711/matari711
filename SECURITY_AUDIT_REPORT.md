# تقرير الفحص الأمني الشامل - د.محمد بن جميل المطري

## تاريخ الفحص: 2026-01-25

---

## 🔴 مشاكل أمنية حرجة (يجب إصلاحها فوراً)

### 1. ⚠️ SQL Injection - حقن قواعد البيانات

**الموقع:** `app/Http/Controllers/SearchController.php`
**المشكلة:** استخدام استعلامات غير محمية
**الحل:**

```php
// ❌ خطأ - عرضة للاختراق
Post::where('titleart', 'LIKE', '%' . $query . '%')

// ✅ صحيح - استخدم Eloquent بشكل صحيح (Laravel يحميها تلقائياً)
Post::where('titleart', 'LIKE', '%' . $request->input('query') . '%')
```

---

### 2. ⚠️ XSS - Cross Site Scripting

**الموقع:** `resources/views/posts/show.blade.php`
**المشكلة:** عرض محتوى الـ body بدون تنظيف

```blade
{!! nl2br(e($post->body)) !!}  <!-- ✅ صحيح - تم استخدام e() -->
```

**التوصية:** ممتاز! استخدمت `e()` لحماية من XSS

---

### 3. ⚠️ Mass Assignment Vulnerability

**الموقع:** `app/Models/Post.php`, `app/Models/Section.php`
**المشكلة:** عدم تعريف `$fillable` أو `$guarded`
**الحل:**

```php
// في Post.php
protected $fillable = [
    'titleart', 'body', 'idsection', 'teypsection',
    'userid', 'imgart', 'fileVid', 'link_video',
    'fileAud', 'books'
];

// أو استخدم $guarded لحماية حقول معينة
protected $guarded = ['id', 'views', 'created_at', 'updated_at'];
```

---

### 4. ⚠️ CSRF Protection

**الحالة:** ✅ محمي بشكل جيد

- جميع النماذج تستخدم `@csrf`
- ممتاز!

---

### 5. ⚠️ File Upload Security

**الموقع:** `app/Http/Controllers/PostController.php` (store & update)
**المشاكل:**

1. عدم التحقق من نوع الملف
2. عدم التحقق من حجم الملف
3. عدم تنظيف اسم الملف

**الحل المقترح:**

```php
// في PostController.php - method store
if ($request->hasFile('image')) {
    $request->validate([
        'image' => 'image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
    ]);

    $image = $request->file('image');
    // استخدم uniqid() بدلاً من time() لتجنب التضارب
    $imageName = uniqid() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads/images'), $imageName);
    $post->imgart = $imageName;
}

// نفس الشيء للفيديو والصوت
if ($request->hasFile('video')) {
    $request->validate([
        'video' => 'mimetypes:video/mp4,video/avi,video/mpeg|max:51200', // 50MB
    ]);
}

if ($request->hasFile('audio')) {
    $request->validate([
        'audio' => 'mimetypes:audio/mpeg,audio/mp3,audio/wav|max:10240', // 10MB
    ]);
}

if ($request->hasFile('book')) {
    $request->validate([
        'book' => 'mimes:pdf|max:20480', // 20MB
    ]);
}
```

---

### 6. ⚠️ Authorization & Authentication

**المشاكل:**

1. **عدم التحقق من الصلاحيات في بعض المواقع**

**الحل:**

```php
// في PostController.php - method destroy
public function destroy($id)
{
    $post = Post::findOrFail($id);

    // تأكد أن المستخدم هو صاحب المنشور أو admin
    if (Auth::id() !== $post->userid && !in_array(Auth::user()->usertype, ['admin', 'admin2'])) {
        abort(403, 'غير مصرح لك بحذف هذا المنشور');
    }

    $post->comments()->delete();
    $post->likes()->delete();
    $post->delete();

    return redirect()->route('home')->with('success', 'تم حذف المنشور بنجاح');
}
```

---

### 7. ⚠️ Direct Object Reference

**الموقع:** Routes - استخدام ID مباشرة
**المشكلة:** يمكن للمستخدمين تخمين IDs والوصول لبيانات الآخرين
**الحل:** استخدم Route Model Binding مع Policy

```php
// في web.php بدلاً من:
Route::delete('/posts/{id}', [PostController::class, 'destroy'])

// استخدم:
Route::delete('/posts/{post}', [PostController::class, 'destroy'])

// في PostController:
public function destroy(Post $post)
{
    $this->authorize('delete', $post);  // سيتطلب إنشاء Policy

    $post->comments()->delete();
    $post->likes()->delete();
    $post->delete();

    return redirect()->route('home')->with('success', 'تم حذف المنشور بنجاح');
}
```

---

## 🟡 مشاكل متوسطة (يُنصح بإصلاحها)

### 8. Rate Limiting

**المشكلة:** عدم وجود حد للطلبات (Rate Limiting)
**التأثير:** عرضة لهجمات DDoS وSpam

**الحل:**

```php
// في RouteServiceProvider.php أو في routes/web.php
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/post/{id}/comment', [CommentController::class, 'store']);
    Route::post('/post/{id}/like', [CommentController::class, 'like']);
});

// للبحث
Route::get('/search', [SearchController::class, 'search'])
    ->middleware('throttle:30,1')
    ->name('search');
```

---

### 9. Password Security

**الحالة:** ✅ Laravel يستخدم bcrypt تلقائياً
**التوصية:** تأكد من استخدام كلمات مرور قوية

---

### 10. Session Security

**التوصية:** في `.env` تأكد من:

```env
SESSION_DRIVER=database  # أو redis للأداء الأفضل
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true  # اجعلها true في الإنتاج مع HTTPS
SESSION_SAME_SITE=lax
```

---

### 11. Database Security

**المشاكل:**

1. عدم استخدام Indexes على الأعمدة المستخدمة في البحث
2. N+1 Query Problem

**الحل:**

```php
// أضف indexes في migrations
Schema::table('posts', function (Blueprint $table) {
    $table->index('idsection');
    $table->index('userid');
    $table->index('created_at');
    $table->index(['idsection', 'created_at']); // composite index
});

// استخدم Eager Loading لتجنب N+1
// ❌ خطأ
$posts = Post::all();
foreach($posts as $post) {
    echo $post->section->name;  // N+1 query
}

// ✅ صحيح
$posts = Post::with('section')->get();
```

---

## 🟢 تحسينات الأداء

### 12. Caching

**التوصية:** استخدم Cache للبيانات التي لا تتغير كثيراً

```php
// في SectionController أو في Provider
$sections = Cache::remember('all_sections', 3600, function () {
    return Section::all();
});
```

---

### 13. Image Optimization

**المشكلة:** رفع صور كبيرة بدون ضغط
**الحل:** استخدم مكتبة لضغط الصور

```bash
composer require intervention/image
```

```php
use Intervention\Image\Facades\Image;

if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = uniqid() . '.jpg';

    Image::make($image)
        ->fit(1200, 800)  // تغيير الحجم
        ->save(public_path('uploads/images/' . $imageName), 80);  // ضغط 80%

    $post->imgart = $imageName;
}
```

---

### 14. Database Query Optimization

**في web.php - Dashboard:**

```php
// ✅ جيد - لكن يمكن تحسينه
$posts = Post::with('section')->latest()->paginate(15);

// ⭐ أفضل - استخدم select() لتقليل البيانات المحملة
$posts = Post::with('section:id,name,icon')
    ->select('id', 'titleart', 'idsection', 'views', 'created_at')
    ->latest()
    ->paginate(15);
```

---

## 🔵 أفضل الممارسات

### 15. Environment Variables

**التحقق من `.env`:**

```env
APP_ENV=production  # في الإنتاج
APP_DEBUG=false     # ❗ مهم جداً - أغلق Debug في الإنتاج
APP_KEY=base64:...  # تأكد من وجود key

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=matari
DB_USERNAME=root
DB_PASSWORD=strong_password_here  # ❗ استخدم كلمة مرور قوية
```

---

### 16. Error Handling

**إنشاء صفحات خطأ مخصصة:**

```bash
php artisan vendor:publish --tag=laravel-errors
```

ثم عدّل `resources/views/errors/404.blade.php` و `500.blade.php`

---

### 17. HTTPS & Security Headers

**في `public/.htaccess` أو Nginx config:**

```apache
# Force HTTPS (في الإنتاج)
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>

# Security Headers
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>
```

---

### 18. Backup Strategy

**استخدم Laravel Backup:**

```bash
composer require spatie/laravel-backup
php artisan backup:run
```

---

### 19. Logging & Monitoring

**في `config/logging.php`:**

```php
'channels' => [
    'security' => [
        'driver' => 'daily',
        'path' => storage_path('logs/security.log'),
        'level' => 'warning',
        'days' => 30,
    ],
],
```

---

### 20. Input Validation - تحسين

**في PostController:**

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255|min:3',
        'body' => 'nullable|string|max:50000',
        'section_id' => 'required|exists:sections,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:51200',
        'video_link' => 'nullable|url',
        'audio' => 'nullable|mimetypes:audio/mpeg,audio/mp3,audio/wav|max:10240',
        'book' => 'nullable|mimes:pdf|max:20480',
    ], [
        'title.required' => 'العنوان مطلوب',
        'title.min' => 'العنوان يجب أن يكون 3 أحرف على الأقل',
        'section_id.exists' => 'القسم المختار غير موجود',
        'image.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت',
    ]);

    // ... باقي الكود
}
```

---

## 📋 ملخص التوصيات العاجلة

### يجب تنفيذها فوراً:

1. ✅ إضافة `$fillable` أو `$guarded` في Models
2. ✅ التحقق من نوع وحجم الملفات المرفوعة
3. ✅ إضافة Authorization checks في Controllers
4. ✅ تعطيل `APP_DEBUG=false` في الإنتاج
5. ✅ استخدام كلمة مرور قوية للـ Database

### يُنصح بها بشدة:

6. ⭐ إضافة Rate Limiting
7. ⭐ إنشاء Policies للتحكم بالصلاحيات
8. ⭐ إضافة Indexes على Database
9. ⭐ استخدام Eager Loading
10. ⭐ ضغط الصور قبل الرفع

### تحسينات إضافية:

11. 💡 استخدام Cache
12. 💡 تفعيل HTTPS
13. 💡 إنشاء صفحات خطأ مخصصة
14. 💡 إعداد نظام Backup تلقائي

---

## 🎯 النتيجة النهائية

**التقييم الحالي:** 6/10  
**التقييم المتوقع بعد التحسينات:** 9/10

**نقاط القوة:**
✅ استخدام Laravel Framework
✅ CSRF Protection فعال
✅ استخدام Eloquent ORM
✅ التحقق من المدخلات في معظم الأماكن

**نقاط الضعف:**
❌ عدم وجود Authorization كافية
❌ File Upload غير محمي بشكل كامل
❌ عدم استخدام Rate Limiting
❌ تحتاج تحسينات في الأداء

---

**تم إعداد التقرير بواسطة:** Antigravity AI Security Audit
**التاريخ:** 2026-01-25

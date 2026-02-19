# 🚀 دليل رفع الموقع على Hostinger - الإنتاج

## 📋 نظرة عامة

هذا الدليل خاص بـ **Hostinger** ويضمن عمل جميع التعديلات في الإنتاج.

---

## ✅ الخطوة 1: حل مشكلة nginx (413 Error)

### **المشكلة:**

```
413 Request Entity Too Large
```

### **الحل:**

#### **الخيار 1: عبر لوحة التحكم (hPanel)** ⭐ الأسهل

1. سجل الدخول إلى hPanel
2. اذهب إلى **Advanced** → **PHP Configuration**
3. اختر إصدار PHP الخاص بك
4. ابحث عن:
   - `upload_max_filesize` → اجعلها **2048M**
   - `post_max_size` → اجعلها **2048M**
   - `max_execution_time` → اجعلها **600**
   - `max_input_time` → اجعلها **600**
   - `memory_limit` → اجعلها **512M**
5. احفظ التغييرات

#### **الخيار 2: استخدام ملف `.user.ini`** (لو الخيار 1 ما اشتغل)

✅ **هذا الملف موجود عندك بالفعل!** (`public/.user.ini`)

فقط تأكد أنه مرفوع في مجلد `public_html`:

```ini
upload_max_filesize = 2048M
post_max_size = 2048M
max_execution_time = 600
max_input_time = 600
memory_limit = 512M
output_buffering = On
```

#### **الخيار 3: الاتصال بالدعم الفني** (لو 1 و 2 ما اشتغلوا)

إذا استمر خطأ nginx 413:

1. افتح Ticket في Hostinger Support
2. اطلب منهم:
   ```
   Please increase nginx client_max_body_size to 2048M for my domain.
   ```
3. عادة يردون خلال 24 ساعة

---

## 📦 الخطوة 2: رفع الملفات

### **الملفات المهمة:**

#### **1. تحديث Controller:**

```
app/Http/Controllers/PostController.php
```

✅ يدعم الآن أنواع ملفات أكثر (MKV, FLV, AAC, FLAC...)

#### **2. إعدادات PHP:**

```
public/.user.ini     ← ارفع هذا
public/.htaccess     ← ارفع هذا (موجود)
```

#### **3. Queue Job (اختياري):**

```
app/Jobs/ProcessMediaFile.php
```

#### **4. صورة الشيخ:**

```
public/sheikh-photo.jpg
```

### **كيفية الرفع:**

#### **عبر File Manager:**

1. افتح **File Manager** من hPanel
2. اذهب إلى `public_html`
3. ارفع الملفات:
   - `public/.user.ini` → `public_html/.user.ini`
   - `public/.htaccess` → `public_html/.htaccess`
   - `public/sheikh-photo.jpg` → `public_html/sheikh-photo.jpg`
4. ارفع باقي المشروع عادي

#### **عبر FTP/SFTP:**

```
Host: ftp.yoursite.com
Username: u123456789
Password: كلمة السر
Port: 21 (FTP) أو 22 (SFTP)
```

---

## ⚙️ الخطوة 3: إعدادات قاعدة البيانات

### **إذا كنت تريد استخدام Queue:**

#### **1. إنشاء جداول Queue:**

عبر SSH (إذا متاح):

```bash
ssh u123456789@yoursite.com
cd domains/yoursite.com/public_html
php artisan queue:table
php artisan queue:failed-table
php artisan migrate
```

أو عبر Terminal في hPanel:

```bash
cd ~/domains/yoursite.com/public_html
/usr/bin/php artisan queue:table
/usr/bin/php artisan queue:failed-table
/usr/bin/php artisan migrate
```

#### **2. تحديث `.env`:**

```env
QUEUE_CONNECTION=database
```

---

## 🕐 الخطوة 4: تشغيل Queue Worker (Cron Job)

### **المشكلة:**

على Shared Hosting، لا يمكنك تشغيل `php artisan queue:work` بشكل دائم.

### **الحل: استخدام Cron Job**

#### **1. إنشاء Cron Job:**

1. اذهب إلى **Advanced** → **Cron Jobs** في hPanel
2. أضف Cron Job جديد:

**التكرار:** كل دقيقة

```
* * * * *
```

**الأمر:**

```bash
cd /home/u123456789/domains/yoursite.com/public_html && /usr/bin/php artisan queue:work --stop-when-empty --timeout=600 > /dev/null 2>&1
```

**ملاحظة:** عدّل:

- `/home/u123456789/` → اسم المستخدم الخاص بك
- `yoursite.com` → النطاق الخاص بك

#### **2. بديل: Schedule**

إذا Cron Job ما اشتغل، استخدم Laravel Scheduler:

في `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('queue:work --stop-when-empty --timeout=600')
             ->everyMinute()
             ->withoutOverlapping();
}
```

ثم Cron Job:

```bash
* * * * * cd /home/u123456789/domains/yoursite.com/public_html && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

---

## 📹 الخطوة 5: FFmpeg (ضغط الفيديو)

### **التحقق من وجود FFmpeg:**

عبر SSH أو Terminal:

```bash
which ffmpeg
ffmpeg -version
```

### **السيناريوهات:**

#### **✅ إذا FFmpeg موجود:**

عدّل مسار FFmpeg في `app/Jobs/ProcessMediaFile.php`:

```php
$ffmpeg = FFMpeg::create([
    'ffmpeg.binaries'  => '/usr/bin/ffmpeg',  // المسار الذي ظهر من which ffmpeg
    'ffprobe.binaries' => '/usr/bin/ffprobe',
    'timeout'          => 3600,
    'ffmpeg.threads'   => 4,
]);
```

ثم ثبّت Package:

```bash
composer require php-ffmpeg/php-ffmpeg
```

#### **❌ إذا FFmpeg غير موجود (Shared Hosting):**

**الخيار 1:** اتصل بالدعم واطلب تثبيته

```
Can you please install FFmpeg on the server?
```

**الخيار 2:** **عطّل الضغط** في Queue Job:

في `app/Jobs/ProcessMediaFile.php`:

```php
public function __construct($postId, $filePath, $fileType, $compress = false)
{
    $this->postId = $postId;
    $this->filePath = $filePath;
    $this->fileType = $fileType;
    $this->compress = false; // ← غيّر هنا
}
```

**الخيار 3:** استخدم خدمة خارجية:

- Cloudinary (https://cloudinary.com) - مجاني حتى 25GB
- AWS S3 + Lambda
- Wasabi

---

## 🔐 الخطوة 6: الصلاحيات (Permissions)

### **عبر File Manager:**

1. افتح `public_html`
2. انقر بزر الماوس الأيمن على المجلد → **Permissions**
3. اضبط:

```
storage/               775
storage/app/           775
storage/framework/     775
storage/logs/          775
bootstrap/cache/       775
public/uploads/        775
```

### **عبر SSH:**

```bash
cd ~/domains/yoursite.com/public_html
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/uploads
```

---

## 🧪 الخطوة 7: الاختبار

### **1. اختبار رفع ملف صغير (10MB):**

- اذهب إلى `/admin/posts/create`
- ارفع صورة أو صوت صغير
- يجب أن يعمل ✅

### **2. اختبار رفع ملف متوسط (100MB):**

- جرب رفع فيديو 100MB
- راقب Progress Bar
- إذا نجح ✅

### **3. اختبار رفع ملف كبير (400MB+):**

- ارفع فيديو كبير
- **إذا ظهر 413 Error:**
  - راجع الخطوة 1 (إعدادات PHP)
  - اتصل بالدعم

### **4. اختبار Queue (إذا فعّلت):**

- ارفع فيديو
- افتح `storage/logs/laravel.log`
- ابحث عن: `"بدء معالجة video..."`
- إذا وجدته ✅ Queue يشتغل

---

## 📊 قائمة التحقق النهائية

### **قبل النشر:**

- [ ] تحديث `.env` (قاعدة البيانات، APP_URL)
- [ ] رفع جميع الملفات
- [ ] رفع `.user.ini` و `.htaccess`
- [ ] نسخ `sheikh-photo.jpg`
- [ ] ضبط صلاحيات `storage` و `uploads`
- [ ] تحديث إعدادات PHP من hPanel
- [ ] `php artisan migrate` (لو في migrations جديدة)
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`

### **إذا تريد Queue:**

- [ ] `QUEUE_CONNECTION=database` في `.env`
- [ ] `php artisan queue:table && php artisan migrate`
- [ ] إنشاء Cron Job
- [ ] تأكد من logs: `storage/logs/laravel.log`

### **إذا تريد ضغط:**

- [ ] تأكد من وجود FFmpeg: `which ffmpeg`
- [ ] `composer require php-ffmpeg/php-ffmpeg`
- [ ] عدّل مسار FFmpeg في `ProcessMediaFile.php`

---

## 🆘 حل المشاكل الشائعة على Hostinger

### **المشكلة: 413 Request Entity Too Large**

**الحل:**

1. تأكد من رفع `.user.ini`
2. زد الحدود من hPanel → PHP Configuration
3. اتصل بالدعم لزيادة nginx `client_max_body_size`

### **المشكلة: 500 Internal Server Error**

**الحل:**

```bash
# امسح الكاش
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# تأكد من الصلاحيات
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### **المشكلة: Queue لا يعمل**

**الحل:**

1. تأكد من Cron Job يشتغل (شوف logs في hPanel)
2. جرب الأمر يدوياً:

```bash
/usr/bin/php artisan queue:work --once
```

3. شوف `storage/logs/laravel.log`

### **المشكلة: FFmpeg غير موجود**

**الحل:**

- عطّل الضغط (`compress = false`)
- أو استخدم Cloudinary/AWS S3

### **المشكلة: الصور/الفيديوهات لا تظهر**

**الحل:**

1. تأكد من `APP_URL` صحيح في `.env`
2. تأكد من الصلاحيات: `chmod 775 public/uploads`
3. تأكد من المسار في قاعدة البيانات

---

## 📞 الدعم الفني Hostinger

### **متى تتصل بهم:**

- ✅ إذا استمر خطأ 413 بعد كل المحاولات
- ✅ إذا تحتاج FFmpeg
- ✅ إذا الـ Cron Jobs ما تشتغل
- ✅ إذا تحتاج زيادة resources (RAM, CPU)

### **كيف تتصل:**

1. سجل دخول hPanel
2. **Help** → **Live Chat** أو **Submit Ticket**
3. اكتب بالإنجليزي (أفضل)

**مثال Ticket:**

```
Subject: Increase nginx client_max_body_size

Hello,

I need to upload large video files (up to 2GB) on my website.
Can you please increase the nginx client_max_body_size to 2048M
for my domain: yoursite.com?

Also, I've already set:
- upload_max_filesize = 2048M
- post_max_size = 2048M
in PHP Configuration.

Thank you!
```

---

## 🎯 الملخص السريع

### **الحد الأدنى (بدون Queue ولا ضغط):**

1. ✅ ارفع الملفات على `public_html`
2. ✅ ارفع `.user.ini` و `.htaccess`
3. ✅ زد الحدود من hPanel → PHP Configuration
4. ✅ اضبط الصلاحيات: `storage`, `uploads`
5. ✅ جرّب رفع ملف كبير

**النتيجة:** رفع يشتغل، Progress Bar يشتغل ✅

---

### **الكامل (مع Queue و ضغط):**

1. ✅ كل ما في الحد الأدنى
2. ✅ `QUEUE_CONNECTION=database` في `.env`
3. ✅ `php artisan queue:table && migrate`
4. ✅ إنشاء Cron Job
5. ✅ تثبيت `php-ffmpeg/php-ffmpeg`
6. ✅ تأكد من FFmpeg موجود
7. ✅ عدّل `ProcessMediaFile.php`

**النتيجة:** رفع + معالجة في الخلفية + ضغط تلقائي 🔥

---

## 📁 الملفات الإضافية

### **ملف للتحقق من FFmpeg:**

احفظ في: `public/check-ffmpeg.php`

```php
<?php
exec('which ffmpeg', $output);
echo "FFmpeg Path: " . (isset($output[0]) ? $output[0] : 'Not found') . "\n";

exec('ffmpeg -version', $version);
echo "\nVersion:\n" . implode("\n", $version);
?>
```

ثم افتح: `https://yoursite.com/check-ffmpeg.php`

---

## 🎊 النتيجة النهائية

بعد تطبيق هذا الدليل:

- ✅ رفع ملفات حتى **2GB**
- ✅ Progress Bar يعمل
- ✅ دعم جميع صيغ الفيديو والصوت
- ✅ معالجة في الخلفية (إذا فعّلت Queue)
- ✅ ضغط تلقائي (إذا FFmpeg موجود)
- ✅ صورة الشيخ في Hero
- ✅ تصميم متجاوب 100%
- ✅ دعم الزوم حتى 200%

**🚀 موقع احترافي جاهز للإنتاج!**

---

**آخر تحديث:** 2026-01-31  
**للدعم:** راجع `MEDIA_UPLOAD_GUIDE.md` للتفاصيل الفنية

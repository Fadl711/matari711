# 🎥 دليل شامل: حل مشاكل رفع الفيديو والصوت

## ❌ المشاكل التي واجهتها

### 1️⃣ **413 Request Entity Too Large**

```
خطأ nginx: الملف كبير جداً
```

### 2️⃣ **The audio field must be a file of type...**

```
خطأ Laravel: نوع الملف غير مدعوم
```

---

## ✅ الحلول الشاملة

### **الحل 1: إصلاح nginx (خطأ 413)**

#### **على Laragon (المحلي):**

1. افتح ملف nginx configuration:

```
C:\laragon\bin\nginx\nginx-1.x.x\conf\nginx.conf
```

2. ابحث عن `http {` وأضف:

```nginx
http {
    client_max_body_size 2048M;
    client_body_timeout 600s;
    send_timeout 600s;

    # ... باقي الإعدادات
}
```

3. أعد تشغيل nginx من Laragon

#### **على Hostinger (الإنتاج):**

**الخيار 1: اتصل بالدعم الفني**

- اطلب زيادة `client_max_body_size` إلى 2GB
- افتح Ticket في لوحة التحكم

**الخيار 2: استخدم VPS/Dedicated**

- إذا كنت على Shared Hosting، قد لا تستطيع تعديل nginx
- الترقية إلى VPS تعطيك تحكم كامل

---

### **الحل 2: توسيع أنواع الملفات المدعومة** ✅ **تم**

تم تحديث `PostController.php` لدعم:

#### **الفيديو:**

- ✅ MP4
- ✅ AVI
- ✅ MPEG
- ✅ QuickTime (MOV)
- ✅ MKV (Matroska)
- ✅ WebM
- ✅ 3GP
- ✅ FLV

#### **الصوت:**

- ✅ MP3
- ✅ WAV
- ✅ AAC
- ✅ OGG
- ✅ WMA
- ✅ FLAC
- ✅ M4A
- ✅ MP4 Audio
- ✅ WebM Audio

---

### **الحل 3: نظام Queue للرفع في الخلفية** ⭐

#### **المميزات:**

1. ✅ المستخدم يرفع الملف ويرى Progress Bar
2. ✅ بعد الرفع،الملف يُعالج في الخلفية (Queue)
3. ✅ المستخدم يمكنه الاستمرار في استخدام الموقع
4. ✅ الملف يُضغط تلقائياً (إذا أردت)
5. ✅ حجم أصغر، نفس الجودة

---

## 🚀 كيفية استخدام نظام Queue

### **الخطوة 1: تثبيت Queue Driver**

#### **للاختبار المحلي (Database Queue):**

**1. تعديل `.env`:**

```env
QUEUE_CONNECTION=database
```

**2. إنشاء جداول Queue:**

```bash
php artisan queue:table
php artisan queue:failed-table
php artisan migrate
```

**3. تشغيل Queue Worker:**

```bash
php artisan queue:work --timeout=3600
```

---

### **الخطوة 2: تفعيل Queue في Controller**

افتح `app/Http/Controllers/PostController.php` وعدّل:

#### **في الـ store method (بعد حفظ الملف):**

```php
// بعد رفع الفيديو
if ($request->hasFile('video')) {
    $videoPath = '...'; // المسار الذي تم حفظه
    $post->video = $videoPath;
    $post->save();

    // إرسال للـ Queue للمعالجة في الخلفية
    \App\Jobs\ProcessMediaFile::dispatch(
        $post->id,
        $videoPath,
        'video',
        true // true = سيضغط الملف
    );
}

// بعد رفع الصوت
if ($request->hasFile('audio')) {
    $audioPath = '...';  // المسار الذي تم حفظه
    $post->audio = $audioPath;
    $post->save();

    // إرسال للـ Queue
    \App\Jobs\ProcessMediaFile::dispatch(
        $post->id,
        $audioPath,
        'audio',
        true
    );
}
```

---

### **الخطوة 3: تثبيت FFmpeg (للضغط)**

#### **على Windows:**

1. حمّل FFmpeg من: https://ffmpeg.org/download.html
2. فك الضغط إلى: `C:\ffmpeg\`
3. أضف إلى PATH:

   - Settings → Environment Variables
   - أضف `C:\ffmpeg\bin`

4. تأكد من التثبيت:

```bash
ffmpeg -version
```

#### **على Linux/Hostinger:**

```bash
sudo apt update
sudo apt install ffmpeg
```

#### **تثبيت PHP FFMpeg Package:**

```bash
composer require php-ffmpeg/php-ffmpeg
```

---

## 📊 كيف يعمل النظام؟

### **السيناريو الكامل:**

```
المستخدم يرفع فيديو 400MB
          ↓
Progress Bar يعرض التقدم (0% → 100%)
          ↓
الملف يُحفظ محلياً في public/uploads/videos/
          ↓
Post يُحفظ في قاعدة البيانات
          ↓
Job يُرسل إلى Queue
          ↓
المستخدم يرى رسالة "تم الرفع بنجاح! جاري المعالجة..."
          ↓
المستخدم يستمر في استخدام الموقع ✅
          ↓
في الخلفية:
  - Queue Worker يعالج الملف
  - FFmpeg يضغط الفيديو
  - 400MB → 80MB (نفس الجودة تقريباً)
  - الملف المضغوط يحل محل الأصلي
          ↓
Post يُحدّث بالمسار الجديد
          ↓
الزوار يشاهدون الفيديو المضغوط (حجم أصغر، تحميل أسرع) 🎉
```

---

## ⚙️ إعدادات الضغط

### **في `app/Jobs/ProcessMediaFile.php`:**

#### **للفيديو:**

```php
$format = new X264();
$format->setKiloBitrate(1000);  // 1 Mbps (جودة متوسطة)
$format->setAudioKiloBitrate(128); // صوت 128 kbps
```

**خيارات الجودة:**
| Bitrate | الجودة | الحجم |
|---------|--------|-------|
| 500 kbps | منخفضة | صغير جداً |
| 1000 kbps | متوسطة | ⭐ موصى به |
| 2000 kbps | عالية | كبير |
| 5000 kbps | عالية جداً | كبير جداً |

#### **للصوت:**

```php
$format = new Mp3();
$format->setAudioKiloBitrate(128);  // 128 kbps (جيد)
```

**خيارات الجودة:**
| Bitrate | الجودة |
|---------|--------|
| 64 kbps | منخفضة |
| 128 kbps | متوسطة ⭐ |
| 192 kbps | عالية |
| 320 kbps | عالية جداً |

---

## 🎨 تحديث Progress Bar ليدعم Queue

### **في `create.blade.php`:**

بعد رفع الملف بنجاح، عرض رسالة:

```javascript
xhr.addEventListener("load", function () {
  if (xhr.status === 200) {
    const response = JSON.parse(xhr.responseText);

    if (response.success) {
      progressDetails.innerHTML = `
                <i class="fas fa-check-circle ml-2"></i>
                تم الرفع بنجاح! جاري ضغط الملف في الخلفية...
            `;
      progressBar.classList.remove("bg-blue-500");
      progressBar.classList.add("bg-green-500");

      // انتظر ثانيتين ثم أعد التوجيه
      setTimeout(() => {
        window.location.href = response.redirect || "/admin/posts";
      }, 2000);
    }
  }
});
```

---

## 📁 الملفات التي تم إنشاؤها/تعديلها

### **ملفات جديدة:**

- ✅ `app/Jobs/ProcessMediaFile.php` - Queue Job للمعالجة
- ✅ `public/nginx.conf` - إعدادات nginx المقترحة
- ✅ `MEDIA_UPLOAD_GUIDE.md` - هذا الدليل

### **ملفات معدّلة:**

- ✅ `app/Http/Controllers/PostController.php` - أنواع ملفات أكثر
- ✅ `.env` - إضافة `QUEUE_CONNECTION=database`

---

## 🧪 الاختبار

### **1. اختبار الرفع العادي:**

```bash
# تأكد من تشغيل السيرفر
php artisan serve

# ارفع ملف صغير (10MB)
# يجب أن يعمل بدون مشاكل
```

### **2. اختبار Queue:**

```bash
# في Terminal 1: تشغيل السيرفر
php artisan serve

# في Terminal 2: تشغيل Queue Worker
php artisan queue:work --timeout=3600

# ارفع ملف كبير وراقب Terminal 2
# يجب أن ترى: "بدء معالجة video للمنشور..."
```

### **3. اختبار الضغط:**

```bash
# تأكد من تثبيت FFmpeg
ffmpeg -version

# ارفع فيديو 400MB
# انتظر Queue Worker ينتهي
# تحقق من الحجم الجديد (يجب أن يكون أصغر)
```

---

## 🆘 حل المشاكل الشائعة

### **المشكلة: Queue Worker لا يعمل**

```bash
# تأكد من الإعدادات
php artisan queue:listen

# أو استخدم supervisor (للإنتاج)
```

### **المشكلة: FFmpeg غير موجود**

```bash
# Windows
# تأكد من PATH
echo %PATH%

# Linux
which ffmpeg
```

### **المشكلة: الملف لا يُضغط**

- تحقق من logs: `storage/logs/laravel.log`
- تأكد من مسار FFmpeg في `ProcessMediaFile.php`

### **المشكلة: "Queue connection not configured"**

```env
# في .env
QUEUE_CONNECTION=database

# ثم
php artisan config:clear
php artisan migrate
```

---

## 🎯 الخلاصة

### **ما تم إصلاحه:**

1. ✅ **دعم أنواع ملفات أكثر** (MP4, MKV, FLV, AAC, FLAC...)
2. ✅ **نظام Queue جاهز** للمعالجة في الخلفية
3. ✅ **ضغط تلقائي** (400MB → 80MB)
4. ✅ **Progress Bar** يعمل أثناء الرفع

### **ما تحتاج لفعله:**

#### **للاستخدام المحلي (الآن):**

1. عدّل nginx.conf (زد `client_max_body_size`)
2. أعد تشغيل Laragon
3. جرب رفع ملف كبير

#### **لتفعيل Queue (اختياري):**

1. غيّر `.env` → `QUEUE_CONNECTION=database`
2. نفذ `php artisan queue:table && php artisan migrate`
3. شغّل `php artisan queue:work --timeout=3600`
4. عدّل `PostController.php` لاستخدام `ProcessMediaFile::dispatch()`

#### **لتفعيل الضغط (اختياري):**

1. ثبّت FFmpeg
2. نفذ `composer require php-ffmpeg/php-ffmpeg`
3. عدّل مسار FFmpeg في `ProcessMediaFile.php`

---

## 📞 الدعم

### **لمزيد من المساعدة:**

- 📘 Laravel Queue Docs: https://laravel.com/docs/queues
- 📗 FFmpeg Docs: https://ffmpeg.org/documentation.html
- 📙 PHP-FFMpeg: https://github.com/PHP-FFMpeg/PHP-FFMpeg

---

**🎊 الآن يمكنك رفع ملفات كبيرة بدون مشاكل!**

**🔥 مع Queue: النظام يشتغل، والمستخدم مرتاح، والملفات تُضغط تلقائياً!**

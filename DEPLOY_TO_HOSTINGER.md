# 🚀 رفع المشروع على Hostinger - الدليل النهائي

## 📋 **قائمة فحص قبل الرفع:**

### ✅ **تم بالفعل:**

- ✅ Progress Bar يعمل
- ✅ Queue محسّن
- ✅ دعم جميع صيغ الصوت والفيديو
- ✅ Favicon جاهز (تحتاج فقط نسخ الملفات)
- ✅ ProcessMediaFile.php جاهز
- ✅ PostController.php محدّث

---

## 🎯 **خطوات الرفع (بالترتيب):**

### **المرحلة 1: رفع الملفات** 📁

#### **الطريقة الأسهل: FTP**

**1. افتح FileZilla (أو أي FTP Client):**

```
Host: ftp.ytravelio.com (أو IP السيرفر)
Username: u477650497
Password: (كلمة سر FTP)
Port: 21
```

**2. ارفع كل الملفات:**

```
من: d:\laragon\www\matari1\
إلى: /domains/ytravelio.com/public_html/mat/
```

**⏱️ الوقت:** 10-20 دقيقة حسب سرعة الانترنت

**ملاحظة:** لا ترفع:

- ❌ `node_modules/`
- ❌ `vendor/` (سنعيد تثبيته على السيرفر)
- ❌ `.env` (سنعدّله على السيرفر)

---

### **الطريقة البديلة: عبر SSH**

**1. ضغط المشروع محلياً:**

```bash
# في d:\laragon\www\matari1
tar -czf matari1.tar.gz --exclude=node_modules --exclude=vendor .
```

**2. رفع عبر SCP:**

```bash
scp -P 65002 matari1.tar.gz u477650497@82.198.227.94:~/
```

**3. فك الضغط:**

```bash
ssh -p 65002 u477650497@82.198.227.94
cd ~/domains/ytravelio.com/public_html/mat
tar -xzf ~/matari1.tar.gz
```

---

### **المرحلة 2: الإعدادات على Hostinger** ⚙️

أنت متصل بـ SSH بالفعل ✅

#### **1. اذهب للمجلد:**

```bash
cd ~/domains/ytravelio.com/public_html/mat
```

#### **2. تحديث `.env`:**

```bash
nano .env
```

**غيّر هذه القيم:**

```env
APP_NAME="الشيخ الدكتور محمد المطري"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://mat.ytravelio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u477650497_matari  # اسم قاعدة البيانات من hPanel
DB_USERNAME=u477650497_matari  # المستخدم من hPanel
DB_PASSWORD=YOUR_DB_PASSWORD   # كلمة السر من hPanel

# Queue (اختياري - إذا تريد تفعيله)
QUEUE_CONNECTION=database   # أو sync إذا ما تريد Queue

# الباقي ابقِه كما هو
```

**احفظ:** `Ctrl+X` → `Y` → `Enter`

---

#### **3. تثبيت Composer dependencies:**

```bash
composer install --optimize-autoloader --no-dev
```

**⏱️ الوقت:** 2-5 دقائق

---

#### **4. إعدادات الصلاحيات:**

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/uploads

# إذا المجلدات غير موجودة
mkdir -p public/uploads/{videos,audio,images,books}
chmod -R 775 public/uploads
```

---

#### **5. مسح الكاش وتحديث:**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
```

---

#### **6. إذا تريد Queue (اختياري):**

**أ) إنشاء الجداول:**

```bash
php artisan queue:table
php artisan queue:failed-table
php artisan migrate
```

**ب) إضافة Cron Job من hPanel:**

1. اذهب hPanel → **Advanced** → **Cron Jobs**
2. اضغط **Add New Cron Job**
3. التكرار: `* * * * *` (كل دقيقة)
4. الأمر:

```bash
cd /home/u477650497/domains/ytravelio.com/public_html/mat && /usr/bin/php artisan queue:work --stop-when-empty --timeout=600 > /dev/null 2>&1
```

5. **Save**

---

### **المرحلة 3: إعدادات PHP (hPanel)** 🔧

**1. سجّل دخول hPanel:**

```
https://hpanel.hostinger.com
```

**2. اذهب Advanced → PHP Configuration**

**3. غيّر هذه القيم:**

```
upload_max_filesize     = 2048
post_max_size           = 2048
max_execution_time      = 600
max_input_time          = 600
memory_limit            = 512
max_file_uploads        = 20
```

**4. اضغط Save**

---

### **المرحلة 4: رفع Favicon** 🎨

**من محلياً:**

1. احفظ صورة المسجد من المحادثة السابقة
2. اذهب: https://realfavicongenerator.net
3. ارفع الصورة
4. حمّل ZIP

**على Hostinger:**
عبر File Manager أو FTP، ارفع الملفات إلى:

```
/domains/ytravelio.com/public_html/mat/public/

favicon.ico
favicon-16x16.png
favicon-32x32.png
apple-touch-icon.png
android-chrome-192x192.png
android-chrome-512x512.png
```

**`site.webmanifest` موجود بالفعل ✅**

---

### **المرحلة 5: اختبار نهائي** 🧪

**1. افتح الموقع:**

```
https://mat.ytravelio.com
```

**2. اختبر الصفحة الرئيسية:**

- ✅ الصور تظهر
- ✅ التصميم سليم
- ✅ Favicon يظهر

**3. اختبر الرفع:**

```
https://mat.ytravelio.com/admin/posts/create
```

- ✅ اختر ملف صغير (5MB)
- ✅ ارفع
- ✅ يجب ينجح

**4. اختبر Progress Bar:**

- ✅ اختر ملف كبير (100MB)
- ✅ ارفع
- ✅ Progress Bar يجب يظهر

**5. اختبر صيغ الصوت:**

- ✅ MP3 ✅
- ✅ WAV ✅
- ✅ M4A ✅
- ✅ أي صيغة ✅

---

## 🔍 **حل المشاكل الشائعة:**

### **المشكلة 1: 500 Internal Server Error**

```bash
# اضبط الصلاحيات
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# امسح الكاش
php artisan config:clear
php artisan cache:clear
```

### **المشكلة 2: الصور لا تظهر**

```bash
# تأكد من الرابط في .env
APP_URL=https://mat.ytravelio.com

# امسح الكاش
php artisan config:cache
```

### **المشكلة 3: خطأ 413 عند الرفع**

- راجع إعدادات PHP (upload_max_filesize)
- اتصل بدعم Hostinger لزيادة nginx limit

### **المشكلة 4: Queue لا يعمل**

```bash
# تحقق من Cron Job
# أو شغّله يدوياً للاختبار:
php artisan queue:work --once
```

---

## 📊 **ملخص سريع:**

### **الأساسي (لازم):**

1. ✅ رفع الملفات (FTP أو SSH)
2. ✅ تحديث `.env`
3. ✅ `composer install`
4. ✅ الصلاحيات
5. ✅ مسح الكاش
6. ✅ إعدادات PHP من hPanel

### **الاختياري (حسب الحاجة):**

7. ⭐ Queue + Cron Job
8. ⭐ Favicon
9. ⭐ FFmpeg (للضغط)

---

## 🎯 **الأوامر السريعة (انسخ والصق):**

```bash
# 1. اذهب للمجلد
cd ~/domains/ytravelio.com/public_html/mat

# 2. تثبيت Dependencies
composer install --optimize-autoloader --no-dev

# 3. الصلاحيات
chmod -R 775 storage bootstrap/cache public/uploads

# 4. الكاش
php artisan config:clear && php artisan cache:clear && php artisan config:cache && php artisan route:cache

# 5. Queue (اختياري)
php artisan queue:table && php artisan queue:failed-table && php artisan migrate

# 6. اختبار
php artisan --version
```

---

## ✅ **قائمة التحقق النهائية:**

- [ ] رفع الملفات ✅
- [ ] تحديث `.env` ✅
- [ ] `composer install` ✅
- [ ] الصلاحيات ✅
- [ ] مسح الكاش ✅
- [ ] إعدادات PHP ✅
- [ ] اختبار الموقع ✅
- [ ] اختبار الرفع ✅
- [ ] Queue (اختياري) ⭐
- [ ] Favicon (اختياري) ⭐

---

## 🆘 **محتاج مساعدة؟**

**أخطاء شائعة:**

- راجع `storage/logs/laravel.log`
- أو عبر SSH: `tail -f storage/logs/laravel.log`

**دعم Hostinger:**

- Live Chat في hPanel
- أو Submit Ticket

---

**🎉 بالتوفيق! الموقع جاهز للإطلاق!**

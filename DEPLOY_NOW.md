# 🚀 خطوات الرفع النهائية (بدون Queue)

## ✅ ما تحتاجه فقط:

### 1️⃣ **إعدادات PHP (hPanel)**

- ✅ `upload_max_filesize` → 2048M
- ✅ `post_max_size` → 2048M
- ✅ `max_execution_time` → 600

### 2️⃣ **رفع الملفات**

```bash
# عبر FTP أو File Manager، ارفع:
- كل ملفات المشروع → public_html/
- public/.user.ini → public_html/.user.ini
- public/.htaccess → public_html/.htaccess
- public/sheikh-photo.jpg → public_html/sheikh-photo.jpg
- جميع favicon files → public_html/
```

### 3️⃣ **الصلاحيات (عبر SSH)**

```bash
cd ~/domains/yoursite.com/public_html
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/uploads
```

### 4️⃣ **تحديث .env**

```env
APP_URL=https://yoursite.com
DB_HOST=...
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

# ابقِ هذا كما هو:
QUEUE_CONNECTION=sync  ← sync = بدون Queue
```

### 5️⃣ **تشغيل Migrations (إذا لزم)**

```bash
php artisan migrate
php artisan config:cache
php artisan route:cache
```

### 6️⃣ **الاختبار**

```
https://yoursite.com/admin/posts/create
- ارفع ملف صغير (10MB)
- ارفع ملف كبير (100MB+)
- يجب يعمل ✅
```

---

## ❌ **ما لا تحتاجه (تجاهل تماماً):**

```
❌ queue:table
❌ queue:work
❌ Cron Job
❌ FFmpeg
❌ composer require php-ffmpeg/php-ffmpeg

كل هذا اختياري! لا تشغل بالك
```

---

## 🎯 **الخلاصة:**

### **الآن:**

1. ارفع الموقع على Hostinger
2. اضبط إعدادات PHP
3. اختبر الرفع
4. أطلق الموقع ✅

### **مستقبلاً (إذا احتجت Queue):**

- راجع `PROCESSMEDIA_GUIDE.md`
- اتبع الخطوات بالتفصيل
- لكن الآن: **لا تحتاجه!**

---

**✨ ركّز على الإطلاق، Queue لاحقاً إذا احتجت!**

# ✅ تفعيل Queue - الخطوات النهائية

## 📋 **ما تم حتى الآن:**

- ✅ تعديل `PostController.php` - يرسل للـ Queue
- ✅ `ProcessMediaFile.php` جاهز
- ✅ Queue Worker شغال محلياً

---

## 🚀 **الخطوات المتبقية:**

### **1️⃣ تحديث `.env`** (افتحه واضبط):

```env
QUEUE_CONNECTION=database
```

احفظ: `Ctrl + S`

---

### **2️⃣ إنشاء جداول Queue** (Terminal):

```bash
php artisan queue:table
php artisan queue:failed-table
php artisan migrate
```

---

### **3️⃣ امسح الكاش:**

```bash
php artisan config:clear
php artisan cache:clear
```

---

### **4️⃣ اختبر محلياً:**

#### **Terminal 1: السيرفر**

```bash
php artisan serve
```

#### **Terminal 2: Queue Worker**

```bash
php artisan queue:work
```

#### **Terminal 3 (اختياري): راقب logs**

```bash
tail -f storage/logs/laravel.log
```

#### **المتصفح:**

```
http://localhost:8000/admin/posts/create
```

**ارفع ملف:**

- ✅ Progress Bar يظهر
- ✅ الرفع ينتهي بسرعة
- ✅ المستخدم يروح للصفحة الرئيسية
- ✅ Queue Worker يعالج في الخلفية

---

## 🌐 **على Hostinger:**

### **التعديلات:**

#### **1. رفع الملفات:**

```
app/Http/Controllers/PostController.php  ← محدّث
app/Jobs/ProcessMediaFile.php            ← موجود
```

#### **2. SSH Commands:**

```bash
cd ~/domains/yoursite.com/public_html/mat

# تحديث .env
nano .env
# غيّر: QUEUE_CONNECTION=database
# احفظ: Ctrl+X → Y → Enter

# إنشاء الجداول
php artisan queue:table
php artisan queue:failed-table
php artisan migrate

# امسح الكاش
php artisan config:clear
```

#### **3. إضافة Cron Job** (hPanel):

```
التكرار: * * * * *

الأمر:
cd /home/u477650497/domains/ytravelio.com/public_html/mat && /usr/bin/php artisan queue:work --stop-when-empty --timeout=600 > /dev/null 2>&1
```

---

## 🧪 **الاختبار:**

### **المحلي:**

```
1. شغّل php artisan queue:work (Terminal 2)
2. ارفع ملف
3. شوف Terminal 2 → يجب تشوف: "Processing jobs..."
4. شوف logs: storage/logs/laravel.log
```

### **على Hostinger:**

```
1. ارفع ملف
2. شوف: عملتم إضافة المنشور بنجاح! جاري معالجة...
3. انتظر دقيقة (Cron Job يشتغل)
4. تحقق من logs عبر SSH:
   tail -f ~/domains/yoursite.com/public_html/mat/storage/logs/laravel.log
```

---

## ✅ **النتيجة:**

```
✅ المستخدم يرفع → Progress Bar يعرض التقدم
✅ الرفع ينتهي → المستخدم يشوف "تم بنجاح"
✅ النظام ما يتوقف → المستخدم يستمر
✅ Queue Worker يشتغل في الخلفية
✅ FFmpeg (إذا موجود) يضغط الملف
```

---

## 📝 **ملاحظات:**

- **FFmpeg:** معطّل حالياً (`false` في dispatch)
- **الضغط:** لو تريد تفعيله، غيّر `false` → `true`
- **Cron Job:** يشتغل كل دقيقة على Hostinger

---

**🎉 كل شيء جاهز! نفّذ الخطوات وجرّب!**

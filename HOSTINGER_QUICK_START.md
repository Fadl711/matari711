# ✅ خطوات سريعة - Hostinger الآن!

## 🎯 افعل هذا الآن (5 دقائق)

### **1. إعدادات PHP من hPanel**

1. سجل دخول Hostinger
2. **Advanced** → **PHP Configuration**
3. غيّر:
   ```
   upload_max_filesize     → 2048
   post_max_size           → 2048
   max_execution_time      → 600
   max_input_time          → 600
   memory_limit            → 512
   ```
4. **Save**

---

### **2. ارفع هذه الملفات**

عبر **File Manager**:

```
من مشروعك              →  إلى Hostinger
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
public/.user.ini        →  public_html/.user.ini
public/.htaccess        →  public_html/.htaccess
public/sheikh-photo.jpg →  public_html/sheikh-photo.jpg

app/Http/Controllers/
  PostController.php    →  public_html/app/Http/Controllers/

(وباقي المشروع عادي)
```

---

### **3. اضبط الصلاحيات**

في File Manager، انقر يمين على المجلد → Permissions:

```
storage/            →  775
bootstrap/cache/    →  775
public/uploads/     →  775
```

---

### **4. لو ما اشتغل (خطأ 413)**

**افتح Ticket عند الدعم:**

```
Subject: Increase nginx upload limit

Hi, I'm getting "413 Request Entity Too Large" error.
Please increase nginx client_max_body_size to 2048M.
Domain: yoursite.com
Thank you!
```

---

## 🎉 خلاص! جرّب الآن

1. اذهب لموقعك: `/admin/posts/create`
2. ارفع فيديو أو صوت
3. يجب يشتغل ✅

---

## 🔥 إذا تبي Queue (اختياري)

### **أضف Cron Job:**

**Advanced** → **Cron Jobs** → Add New

```
التكرار:  * * * * *
الأمر:
cd /home/u123456789/domains/yoursite.com/public_html && /usr/bin/php artisan queue:work --stop-when-empty > /dev/null 2>&1
```

(عدّل `u123456789` و `yoursite.com`)

---

## 📞 مشاكل؟

راجع: `HOSTINGER_PRODUCTION_GUIDE.md` (دليل كامل)

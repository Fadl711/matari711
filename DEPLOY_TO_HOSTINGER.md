# دليل رفع مشروع Laravel على Hostinger باستخدام Git (Subdomain)

هذه الطريقة هي الأفضل والأكثر احترافية، حيث تسمح لك بتحديث موقعك بسهولة بمجرد عمل `git push`.

## 1. رفع المشروع إلى GitHub

1.  أنشئ Repository جديد على GitHub (يفضل أن يكون Private).
2.  ارفع مشروعك المحلي إليه:
    ```bash
    git init
    git add .
    git commit -m "First commit"
    git branch -M main
    git remote add origin https://github.com/USERNAME/REPO_NAME.git
    git push -u origin main
    ```
    _(استبدل الرابط برابط الـ Repo الخاص بك)_.

## 2. تجهيز الـ Subdomain وقاعدة البيانات في Hostinger

1.  **أنشئ قاعدة البيانات**:

    - اذهب إلى **Databases** -> **Management**.
    - أنشئ قاعدة جديدة واحفظ بياناتها (الاسم، المستخدم، كلمة المرور).
    - ارفع ملف `.sql` الخاص بك عبر phpMyAdmin.

2.  **أنشئ Subdomain**:
    - اذهب إلى **Websites** -> **Manage** -> **Subdomains**.
    - أنشئ النطاق الفرعي (مثلاً `app`).
    - انسخ مسار المجلد (مثلاً `/domains/yourdomain.com/public_html/app`).

## 3. إعداد مفتاح Deployment Key (إذا كان الـ Repo خاص - Private)

إذا كان المشروع Private، ستحتاج لمفتاح SSH للوصول إليه:

1.  في Hostinger، اذهب إلى **Advanced** -> **GIT**.
2.  أنشئ مفتاح SSH جديد (إذا لم يوجد) وانسخه.
3.  اذهب إلى إعدادات الـ Repo في GitHub -> **Settings** -> **Deploy constants**.
4.  أضف المفتاح الجديد، اختر اسم (مثلاً "Hostinger") وضع المفتاح وأعطه صلاحية للقراءة.

## 4. ربط Git في Hostinger

1.  في Hostinger، اذهب إلى صفحة **GIT**.
2.  **Repository**: ضع رابط الـ Repo الخاص بك (SSH أو HTTPS).
3.  **Branch**: عادةً `main`.
4.  **Directory**: اكتب مسار النطاق الفرعي **بدون Slash في البداية** (مثلاً `public_html/app`). **مهم جداً أن يكون المسار صحيحاً وفارغاً**.
    - _نصيحة:_ اذهب إلى File Manager واحذف أي ملفات داخل مجلد `app` قبل الربط.
5.  اضغط **Create**.
6.  سيقوم Hostinger بسحب ملفات المشروع من GitHub.

## 5. تثبيت الاعتمادات (Composer Install)

بعد سحب الملفات، ستحتاج لتثبيت مكتبات Laravel.

1.  يمكنك استخدام **SSH Access** (الأفضل) في Hostinger.
2.  ادخل عبر Terminal أو Putty.
3.  انتقل لمجلد النطاق الفرعي:
    ```bash
    cd domains/yourdomain.com/public_html/app
    ```
4.  نفذ أوامر التثبيت:
    ```bash
    composer install --optimize-autoloader --no-dev
    cp .env.example .env
    php artisan key:generate
    ```

## 6. إعداد ملف البيئة (.env)

1.  في File Manager، اذهب لمجلد المشروع `public_html/app`.
2.  عدّل ملف `.env` وأضف بيانات قاعدة البيانات التي أنشأتها وتأكد من `APP_URL`.

## 7. توجيه السيرفر (.htaccess)

في **المجلد الرئيسي للنطاق الفرعي** (`public_html/app`)، أنشئ ملف `.htaccess` (أو عدله) ليحتوي الكود التالي لتوجيه الزوار لمجلد `public`:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Front Controller...
    RewriteCond %{REQUEST_URI} !(\.css|\.js|\.png|\.jpg|\.gif|robots\.txt)$ [NC]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(css|js|images)/(.*)$ public/$1/$2 [L,NC]

    RewriteRule ^((?!public/).*)$ public/$1 [L,NC]
</IfModule>
```

## 8. أمر التحديث (للمستقبل)

في كل مرة ترفع تعديلات على GitHub:

1.  اذهب إلى صفحة **GIT** في Hostinger.
2.  بجانب الـ Repo، اضغط **Deploy**.
3.  سيتم سحب التحديثات فوراً.
    - إذا أضفت مكتبات جديدة، ستحتاج لتشغيل `composer install` مرة أخرى عبر SSH.

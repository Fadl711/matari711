<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titleart',
        'body',
        'imgart',
        'idsection',
        'teypsection',
        'userid',
        'fileVid',
        'link_video',
        'fileAud',
        'books',
        'is_pinned',
    ];

    protected $guarded = ['id', 'views'];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    /**
     * العلاقة مع القسم
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'idsection');
    }

    /**
     * العلاقة مع المستخدم (الكاتب)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    /**
     * العلاقة مع التعليقات
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    /**
     * العلاقة مع الإعجابات
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    /**
     * الحصول على عدد الإعجابات
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->sum('print_like');
    }

    /**
     * Accessor للعنوان
     */
    public function getTitleAttribute()
    {
        return $this->titleart;
    }

    /**
     * الحصول على رابط الصورة
     */
    public function getImageAttribute()
    {
        if ($this->imgart) {
            // إذا كان الرابط كامل (من R2 أو URL خارجي)
            if (str_starts_with($this->imgart, 'http')) {
                return $this->imgart;
            }
            // إذا كان ملف محلي جديد (في uploads/images)
            if (file_exists(public_path('uploads/images/' . $this->imgart))) {
                return asset('uploads/images/' . $this->imgart);
            }
            // إذا كان ملف قديم (في book أو مسار آخر)
            if (file_exists(public_path('book/' . $this->imgart))) {
                return asset('book/' . $this->imgart);
            }
            // مسار افتراضي
            return asset('uploads/images/' . $this->imgart);
        }
        return null;
    }

    /**
     * الحصول على مقتطف من المحتوى
     */
    public function getExcerptAttribute()
    {
        if ($this->body) {
            return mb_substr(strip_tags($this->body), 0, 150) . '...';
        }
        return '';
    }
}

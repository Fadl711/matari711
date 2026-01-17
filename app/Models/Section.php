<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_Name',
    ];

    /**
     * العلاقة مع المنشورات
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'idsection');
    }

    /**
     * Accessor للاسم - باستخدام الطريقة القديمة المتوافقة
     */
    public function getNameAttribute()
    {
        return $this->attributes['section_Name'] ?? '';
    }

    /**
     * الحصول على عدد المنشورات
     */
    public function getPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    /**
     * الحصول على أيقونة القسم
     */
    public function getIconAttribute()
    {
        $sectionName = trim($this->attributes['section_Name'] ?? '');

        // محاولة إيجاد الاسم كما هو أو بدون "ال" التعريفية
        $normalizedName = $sectionName;
        if (str_starts_with($sectionName, 'ال')) {
            $normalizedName = mb_substr($sectionName, 2);
        }

        $icons = [
            'مقالات' => 'fa-file-alt',
            'مقال' => 'fa-file-alt',
            'كتب' => 'fa-book',
            'كتاب' => 'fa-book',
            'صوتيات' => 'fa-headphones',
            'صوت' => 'fa-headphones',
            'فيديوهات' => 'fa-video',
            'فيديو' => 'fa-video',
            'video' => 'fa-video',
            'فتاوى' => 'fa-question-circle',
            'فتوى' => 'fa-question-circle',
            'دروس' => 'fa-chalkboard-teacher',
            'درس' => 'fa-chalkboard-teacher',
            'خطب' => 'fa-microphone',
            'خطبة' => 'fa-microphone',
            'بحوث' => 'fa-file-signature',
            'بحث' => 'fa-file-signature',
        ];

        return $icons[$sectionName] ?? ($icons[$normalizedName] ?? 'fa-folder');
    }
}

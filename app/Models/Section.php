<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_Name',
        'parent_id',
        'icon',
        'sort_order',
    ];

    /**
     * العلاقة مع المنشورات
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'idsection');
    }

    /**
     * القسم الأب
     */
    public function parent()
    {
        return $this->belongsTo(Section::class, 'parent_id');
    }

    /**
     * الأقسام الفرعية
     */
    public function children()
    {
        return $this->hasMany(Section::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * الأقسام الفرعية مع أقسامها الفرعية (recursive)
     */
    public function childrenRecursive()
    {
        return $this->children()->with(['childrenRecursive']);
    }

    /**
     * هل هذا قسم رئيسي؟
     */
    public function getIsParentAttribute()
    {
        return is_null($this->parent_id);
    }

    /**
     * هل هذا قسم فرعي؟
     */
    public function getIsChildAttribute()
    {
        return !is_null($this->parent_id);
    }

    /**
     * جميع المنشورات (من هذا القسم + الأقسام الفرعية)
     */
    public function allPosts()
    {
        $childIds = $this->children()->pluck('id')->toArray();
        $allIds = array_merge([$this->id], $childIds);
        return Post::whereIn('idsection', $allIds);
    }

    /**
     * Accessor للاسم
     */
    public function getNameAttribute()
    {
        return $this->attributes['section_Name'] ?? '';
    }

    /**
     * الحصول على عدد المنشورات (شامل الفرعية)
     */
    public function getPostsCountAttribute()
    {
        return $this->allPosts()->count();
    }

    /**
     * الحصول على أيقونة القسم
     */
    public function getIconAttribute()
    {
        $sectionName = trim($this->attributes['section_Name'] ?? '');

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

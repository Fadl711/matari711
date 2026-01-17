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
        $sectionName = $this->attributes['section_Name'] ?? '';
        
        $icons = [
            'مقالات' => 'fa-file-alt',
            'كتب' => 'fa-book',
            'صوتيات' => 'fa-headphones',
            'فيديوهات' => 'fa-video',
            'video' => 'fa-video',
            'فتاوى' => 'fa-question-circle',
        ];

        return $icons[$sectionName] ?? 'fa-folder';
    }
}

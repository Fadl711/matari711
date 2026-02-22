<?php

namespace App\Observers;

use App\Models\Post;
use Ymigval\LaravelIndexnow\Facade\IndexNow;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    /**
     * عند إنشاء منشور جديد - أرسل الرابط لمحركات البحث فوراً
     */
    public function created(Post $post): void
    {
        $this->submitToIndexNow($post);
    }

    /**
     * عند تحديث منشور - أعلم محركات البحث بالتغيير
     */
    public function updated(Post $post): void
    {
        $this->submitToIndexNow($post);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }

    /**
     * إرسال رابط المنشور لـ IndexNow (Bing, Yandex, ...)
     * في حالة الفشل: نسجل الخطأ فقط ولا نوقف الموقع
     */
    private function submitToIndexNow(Post $post): void
    {
        try {
            $url = route('posts.show', $post->id);
            IndexNow::submit($url);
        } catch (\Exception $e) {
            Log::warning('IndexNow: فشل إرسال رابط المنشور #' . $post->id . ' - ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * معالجة ملفات الوسائط في الخلفية
 *
 * الميزات:
 * - يعمل في التطوير والإنتاج
 * - يتحقق من FFmpeg تلقائياً
 * - يضغط الملفات إذا كان FFmpeg موجود
 * - يخطي الضغط إذا FFmpeg غير موجود (بدون أخطاء)
 */
class ProcessMediaFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $postId;
    protected $filePath;
    protected $fileType; // 'video' or 'audio'
    protected $compress;

    public $timeout = 3600; // 1 hour
    public $tries = 3;
    public $maxExceptions = 1;

    /**
     * Create a new job instance.
     */
    public function __construct($postId, $filePath, $fileType, $compress = true)
    {
        $this->postId = $postId;
        $this->filePath = $filePath;
        $this->fileType = $fileType;
        $this->compress = $compress;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info("بدء معالجة {$this->fileType} للمنشور {$this->postId}");

            $post = Post::findOrFail($this->postId);
            $fullPath = public_path($this->filePath);

            // التحقق من وجود الملف
            if (!file_exists($fullPath)) {
                Log::error("الملف غير موجود: {$fullPath}");
                return;
            }

            // إذا الضغط مفعّل وFFmpeg موجود
            if ($this->compress && $this->isFFmpegAvailable()) {
                $compressedPath = $this->compressMedia($fullPath);

                if ($compressedPath && file_exists($compressedPath)) {
                    // حذف الملف القديم
                    @unlink($fullPath);

                    // تحديث المسار في قاعدة البيانات
                    $newPath = str_replace(public_path(), '', $compressedPath);
                    $newPath = str_replace('\\', '/', $newPath); // Windows compatibility

                    if ($this->fileType === 'video') {
                        $post->video = $newPath;
                    } else {
                        $post->audio = $newPath;
                    }
                    $post->save();

                    Log::info("تم ضغط {$this->fileType} بنجاح للمنشور {$this->postId}");
                }
            } else {
                if (!$this->isFFmpegAvailable()) {
                    Log::info("FFmpeg غير متوفر. تخطي الضغط للمنشور {$this->postId}");
                }
            }

            // يمكن إضافة معالجات أخرى هنا
            // مثلاً: إنشاء thumbnail للفيديو

        } catch (\Exception $e) {
            Log::error("خطأ في معالجة {$this->fileType} للمنشور {$this->postId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * التحقق من وجود FFmpeg
     */
    protected function isFFmpegAvailable(): bool
    {
        // التحقق من Package
        if (!class_exists('FFMpeg\FFMpeg')) {
            return false;
        }

        // التحقق من Binary
        $command = PHP_OS_FAMILY === 'Windows' ? 'where ffmpeg' : 'which ffmpeg';
        exec($command, $output, $returnCode);

        return $returnCode === 0 && !empty($output);
    }

    /**
     * الحصول على مسار FFmpeg حسب النظام
     */
    protected function getFFmpegPath(): array
    {
        if (PHP_OS_FAMILY === 'Windows') {
            // Windows (التطوير)
            return [
                'ffmpeg.binaries'  => 'C:/ffmpeg/bin/ffmpeg.exe',
                'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
            ];
        } else {
            // Linux (الإنتاج - Hostinger)
            // محاولة إيجاد المسار تلقائياً
            exec('which ffmpeg', $ffmpegPath);
            exec('which ffprobe', $ffprobePath);

            return [
                'ffmpeg.binaries'  => !empty($ffmpegPath) ? $ffmpegPath[0] : '/usr/bin/ffmpeg',
                'ffprobe.binaries' => !empty($ffprobePath) ? $ffprobePath[0] : '/usr/bin/ffprobe',
            ];
        }
    }

    /**
     * ضغط ملف الفيديو أو الصوت
     */
    protected function compressMedia(string $inputPath): ?string
    {
        try {
            $paths = $this->getFFmpegPath();

            $ffmpeg = \FFMpeg\FFMpeg::create([
                'ffmpeg.binaries'  => $paths['ffmpeg.binaries'],
                'ffprobe.binaries' => $paths['ffprobe.binaries'],
                'timeout'          => 3600,
                'ffmpeg.threads'   => 4,
            ]);

            $pathInfo = pathinfo($inputPath);
            $outputPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_compressed.' . $pathInfo['extension'];

            if ($this->fileType === 'video') {
                // ضغط الفيديو
                $video = $ffmpeg->open($inputPath);

                $format = new \FFMpeg\Format\Video\X264();
                $format->setKiloBitrate(1000); // 1 Mbps - جودة متوسطة
                $format->setAudioKiloBitrate(128); // 128 kbps

                $video->save($format, $outputPath);

                Log::info("تم ضغط الفيديو: {$outputPath}");
            } else {
                // ضغط الصوت
                $audio = $ffmpeg->open($inputPath);

                $format = new \FFMpeg\Format\Audio\Mp3();
                $format->setAudioKiloBitrate(128); // 128 kbps

                $audio->save($format, $outputPath);

                Log::info("تم ضغط الصوت: {$outputPath}");
            }

            return $outputPath;
        } catch (\Exception $e) {
            Log::error('خطأ في ضغط الملف: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("فشلت معالجة {$this->fileType} للمنشور {$this->postId}: " . $exception->getMessage());

        // يمكن إرسال إشعار للأدمن
        // أو تحديث حالة المنشور في قاعدة البيانات
    }
}

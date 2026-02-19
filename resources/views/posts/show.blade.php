@extends('layout')

@section('title', $post->title)
@section('meta_title', $post->title . ' - الشيخ الدكتور محمد المطري')
@section('meta_description', Str::limit(strip_tags($post->body), 160))
@section('meta_keywords', $post->section->name . '، الشيخ المطري، ' . str_replace(' ', '، ', $post->title))

@section('og_title', $post->title)
@section('og_description', Str::limit(strip_tags($post->body), 200))
@section('og_image', $post->imgart ? asset('uploads/images/' . $post->imgart) : asset('R.png'))
@section('og_type', 'article')

@section('twitter_title', $post->title)
@section('twitter_description', Str::limit(strip_tags($post->body), 200))
@section('twitter_image', $post->imgart ? asset('uploads/images/' . $post->imgart) : asset('R.png'))

@section('content')
    <!-- رأس المنشور -->
    <section class="islamic-gradient py-8 md:py-12">
        <div class="max-w-4xl mx-auto px-4">
            <!-- مسار التنقل -->
            <nav class="mb-6">
                <ol class="flex items-center gap-2 text-sm text-primary-200">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><i class="fas fa-chevron-left text-xs"></i></li>
                    <li>
                        <a href="{{ route('posts.section', $post->idsection) }}" class="hover:text-white transition-colors">
                            {{ $post->section->name }}
                        </a>
                    </li>
                    <li><i class="fas fa-chevron-left text-xs"></i></li>
                    <li class="text-gold-300 truncate max-w-[200px]">{{ $post->title }}</li>
                </ol>
            </nav>

            <!-- معلومات المنشور -->
            <div class="flex flex-wrap items-center gap-4 mb-4">
                <span class="bg-gold-500 text-primary-900 px-4 py-1 rounded-full text-sm font-medium">
                    {{ $post->section->name }}
                </span>
                <span class="text-primary-200 text-sm flex items-center gap-1">
                    <i class="fas fa-calendar-alt"></i>
                    <script>
                        document.write(formatFullDate("{{ $post->created_at->toIso8601String() }}"));
                    </script>
                </span>
            </div>

            <!-- عنوان المنشور -->
            <h1 class="text-2xl md:text-4xl font-bold text-white leading-relaxed">
                {{ $post->title }}
            </h1>
        </div>
    </section>

    <!-- المحتوى الرئيسي -->
    <section class="py-8 md:py-12 bg-cream-100">
        <div class="max-w-4xl mx-auto px-4">

            <!-- أزرار المشاركة (جديد) -->
            <div class="mb-6 flex flex-wrap items-center gap-2 justify-center md:justify-end">
                <span class="text-brown-500 font-bold ml-2">مشاركة المنشور:</span>

                <!-- WhatsApp -->
                <a href="https://wa.me/?text={{ $post->title }}%0A{{ route('posts.show', $post->id) }}" target="_blank"
                    class="bg-[#25D366] text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#128C7E] transition-all transform hover:scale-110 shadow-md">
                    <i class="fab fa-whatsapp text-xl"></i>
                </a>

                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', $post->id) }}" target="_blank"
                    class="bg-[#1877F2] text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#166FE5] transition-all transform hover:scale-110 shadow-md">
                    <i class="fab fa-facebook-f text-lg"></i>
                </a>

                <!-- Twitter / X -->
                <a href="https://twitter.com/intent/tweet?text={{ $post->title }}&url={{ route('posts.show', $post->id) }}"
                    target="_blank"
                    class="bg-black text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-800 transition-all transform hover:scale-110 shadow-md">
                    <i class="fab fa-x-twitter text-lg"></i>
                </a>

                <!-- Telegram -->
                <a href="https://t.me/share/url?url={{ route('posts.show', $post->id) }}&text={{ $post->title }}"
                    target="_blank"
                    class="bg-[#0088cc] text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#007dbb] transition-all transform hover:scale-110 shadow-md">
                    <i class="fab fa-telegram-plane text-xl pr-1"></i>
                </a>
            </div>

            <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- صورة المنشور -->
                @if ($post->image)
                    <div class="relative h-64 md:h-96 bg-gray-100">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-contain">
                    </div>
                @else
                    <div
                        class="relative h-48 md:h-64 bg-primary-600 flex items-center justify-center border-b border-cream-200">
                        <i class="fas fa-mosque text-white text-6xl opacity-50"></i>
                    </div>
                @endif

                <!-- محتوى المنشور -->
                <div class="p-6 md:p-10">

                    @auth
                        @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'admin2')
                            <!-- أزرار التحكم للمشرفين -->
                            <div class="mb-6 flex gap-3 flex-wrap">
                                <button type="button" id="pinBtn" onclick="togglePin({{ $post->id }})"
                                    class="{{ $post->is_pinned ? 'bg-gold-500 hover:bg-gold-600 text-primary-900' : 'bg-gray-500 hover:bg-gray-600 text-white' }} px-4 py-2 rounded-lg transition-colors inline-flex items-center gap-2">
                                    <i class="fas fa-thumbtack"></i>
                                    <span id="pinText">{{ $post->is_pinned ? 'إلغاء التثبيت' : 'تثبيت في الأعلى' }}</span>
                                </button>
                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                    class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                                    <i class="fas fa-edit"></i>
                                    <span>تعديل</span>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا المنشور؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                        <i class="fas fa-trash"></i>
                                        <span>حذف</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <!-- النص الرئيسي -->
                    @if ($post->body)
                        <div class="prose prose-lg max-w-none text-brown-700 leading-loose quill-content">
                            {!! $post->body !!}
                        </div>
                    @endif

                    <!-- الفيديو -->
                    @if ($post->link_video)
                        <div class="mt-8">
                            <h3 class="text-lg font-bold text-brown-700 mb-4 flex items-center gap-2">
                                <i class="fas fa-video text-primary-500"></i>
                                فيديو
                            </h3>
                            <div class="relative rounded-xl overflow-hidden" style="padding-top: 56.25%;">
                                <iframe src="https://www.youtube.com/embed/{{ $post->link_video }}"
                                    class="absolute inset-0 w-full h-full" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    @elseif($post->fileVid)
                        <div class="mt-8">
                            <h3 class="text-lg font-bold text-brown-700 mb-4 flex items-center gap-2">
                                <i class="fas fa-video text-primary-500"></i>
                                فيديو
                            </h3>
                            <video controls class="w-full rounded-xl">
                                <source src="{{ asset('uploads/videos/' . $post->fileVid) }}" type="video/mp4">
                            </video>
                        </div>
                    @endif

                    <!-- الصوت -->
                    @if ($post->fileAud)
                        <div class="mt-8">
                            <h3 class="text-lg font-bold text-brown-700 mb-4 flex items-center gap-2">
                                <i class="fas fa-headphones text-primary-500"></i>
                                صوتية
                            </h3>
                            <div class="flex flex-col gap-3">
                                <audio controls class="w-full">
                                    <source src="{{ asset('uploads/audio/' . $post->fileAud) }}" type="audio/mpeg">
                                </audio>
                                <a href="{{ asset('uploads/audio/' . $post->fileAud) }}" download
                                    class="inline-flex items-center justify-center gap-2 bg-primary-100 text-primary-700 hover:bg-primary-200 transition-colors py-2 px-4 rounded-lg text-sm font-bold self-start">
                                    <i class="fas fa-download"></i>
                                    <span>تحميل المقطع الصوتي</span>
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- الكتاب -->
                    @if ($post->books)
                        <div class="mt-8">
                            <h3 class="text-lg font-bold text-brown-700 mb-4 flex items-center gap-2">
                                <i class="fas fa-book text-primary-500"></i>
                                الكتاب المرفق
                            </h3>

                            <a href="{{ asset('uploads/books/' . $post->books) }}" download
                                class="inline-flex items-center gap-3 bg-primary-500 text-white px-6 py-3 rounded-xl hover:bg-primary-600 transition-colors shadow-md transform hover:-translate-y-1">
                                <i class="fas fa-download"></i>
                                <span>تحميل الكتاب (PDF)</span>
                            </a>
                        </div>
                    @endif
                </div>
            </article>

            <!-- منشورات ذات صلة -->
            @if ($relatedPosts->count() > 0)
                <div class="mt-12">
                    <h3 class="text-xl font-bold text-brown-700 mb-6">منشورات ذات صلة</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach ($relatedPosts as $related)
                            <a href="{{ route('posts.show', $related->id) }}"
                                class="bg-white rounded-xl overflow-hidden shadow-lg card-hover group">
                                <div class="h-32 overflow-hidden bg-gray-100">
                                    @if ($related->image)
                                        <img src="{{ $related->image }}" alt="{{ $related->title }}"
                                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full bg-primary-600 flex items-center justify-center">
                                            <i class="fas fa-mosque text-white text-3xl opacity-50"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h4
                                        class="font-bold text-brown-700 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                        {{ $related->title }}
                                    </h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
        <script>
            // تثبيت/إلغاء تثبيت المنشور
            function togglePin(postId) {
                fetch(`/admin/posts/${postId}/toggle-pin`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            const btn = document.getElementById('pinBtn');
                            const text = document.getElementById('pinText');
                            if (data.is_pinned) {
                                btn.classList.remove('bg-gray-500', 'hover:bg-gray-600', 'text-white');
                                btn.classList.add('bg-gold-500', 'hover:bg-gold-600', 'text-primary-900');
                                text.textContent = 'إلغاء التثبيت';
                            } else {
                                btn.classList.remove('bg-gold-500', 'hover:bg-gold-600', 'text-primary-900');
                                btn.classList.add('bg-gray-500', 'hover:bg-gray-600', 'text-white');
                                text.textContent = 'تثبيت في الأعلى';
                            }
                            showToast(data.message, 'success');
                        }
                    })
                    .catch(err => console.error(err));
            }

            document.addEventListener('DOMContentLoaded', function() {
                const postId = {{ $post->id }};
                const csrfToken = '{{ csrf_token() }}';

                // إعجاب بدون تحديث الصفحة
                const likeBtn = document.getElementById('likeBtn');
                if (likeBtn) {
                    likeBtn.addEventListener('click', function() {
                        fetch(`/post/${postId}/like`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('likesCount').textContent = data.total_likes;
                                    const likeIcon = document.getElementById('likeIcon');
                                    if (data.liked) {
                                        likeIcon.classList.add('text-red-500');
                                    } else {
                                        likeIcon.classList.remove('text-red-500');
                                    }
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                }

                // إضافة تعليق بدون تحديث الصفحة
                const commentForm = document.getElementById('commentForm');
                if (commentForm) {
                    commentForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const commentText = document.getElementById('commentText');
                        const submitBtn = document.getElementById('submitCommentBtn');
                        const submitText = document.getElementById('submitText');
                        const submitSpinner = document.getElementById('submitSpinner');

                        // تعطيل الزر أثناء الإرسال
                        submitBtn.disabled = true;
                        submitText.classList.add('hidden');
                        submitSpinner.classList.remove('hidden');

                        fetch(`/post/${postId}/comment`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    comment: commentText.value
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // إخفاء رسالة "لا توجد تعليقات"
                                    const noCommentsMsg = document.getElementById('noCommentsMsg');
                                    if (noCommentsMsg) {
                                        noCommentsMsg.remove();
                                    }

                                    // إضافة التعليق الجديد في الأعلى
                                    const commentsList = document.getElementById('commentsList');
                                    const newComment = `
                        <div class="border-b border-cream-200 pb-4 mb-4 comment-item" style="animation: fadeIn 0.3s ease-in-out;">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-primary-500"></i>
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-bold text-brown-700">${data.comment.user_name}</span>
                                        <span class="text-sm text-brown-400">${data.comment.created_at}</span>
                                    </div>
                                    <p class="text-brown-600 leading-relaxed">${data.comment.comment}</p>
                                </div>
                            </div>
                        </div>
                    `;
                                    commentsList.insertAdjacentHTML('afterbegin', newComment);

                                    // تحديث عدد التعليقات
                                    const commentsCount = document.getElementById('commentsCount');
                                    const totalComments = document.getElementById('totalComments');
                                    const currentCount = parseInt(commentsCount.textContent) + 1;
                                    commentsCount.textContent = currentCount;
                                    totalComments.textContent = currentCount;

                                    // مسح حقل النص
                                    commentText.value = '';
                                }
                            })
                            .catch(error => console.error('Error:', error))
                            .finally(() => {
                                // إعادة تفعيل الزر
                                submitBtn.disabled = false;
                                submitText.classList.remove('hidden');
                                submitSpinner.classList.add('hidden');
                            });
                    });
                }
            });
        </script>
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @endpush @endsection

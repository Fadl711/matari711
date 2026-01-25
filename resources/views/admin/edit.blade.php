@extends('layout')

@section('title', 'تعديل: ' . $post->title . ' - رواق العلوم الشرعية')

@section('content')
    <section class="py-8 md:py-12 bg-cream-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            <!-- رأس الصفحة -->
            <div class="mb-8">
                <nav class="mb-4">
                    <ol class="flex items-center gap-2 text-sm text-brown-400">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-600"><i class="fas fa-home"></i></a></li>
                        <li><i class="fas fa-chevron-left text-xs"></i></li>
                        <li>لوحة التحكم</li>
                        <li><i class="fas fa-chevron-left text-xs"></i></li>
                        <li class="text-primary-600">تعديل المنشور</li>
                    </ol>
                </nav>
                <h1 class="text-2xl md:text-3xl font-bold text-brown-700">تعديل المنشور</h1>
            </div>

            <!-- نموذج التعديل -->
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                @csrf
                @method('PUT')

                <!-- رسائل الخطأ -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                        <ul class="text-red-600 text-sm list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- العنوان -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-heading ml-1 text-primary-500"></i>
                        عنوان المنشور *
                    </label>
                    <input type="text" name="title" value="{{ old('title', $post->titleart) }}"
                        class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                        required>
                </div>

                <!-- القسم -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-folder ml-1 text-primary-500"></i>
                        القسم *
                    </label>
                    <select name="section_id"
                        class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                        required>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ $post->idsection == $section->id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- المحتوى -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-file-alt ml-1 text-primary-500"></i>
                        المحتوى
                    </label>
                    <textarea name="body" id="tinymce-body" rows="8"
                        class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200 resize-none">{{ old('body', $post->body) }}</textarea>
                </div>

                <!-- الصورة الحالية -->
                @if ($post->imgart)
                    <div class="mb-4">
                        <label class="block text-brown-700 font-medium mb-2">الصورة الحالية</label>
                        <div class="relative inline-block">
                            <img src="{{ $post->image }}" alt="" class="max-h-48 rounded-lg" id="currentImage">
                            <button type="button" onclick="removeImage()"
                                class="absolute top-2 right-2 bg-red-500 text-white w-8 h-8 rounded-full hover:bg-red-600 transition-colors shadow-lg">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <input type="hidden" name="remove_image" id="removeImageInput" value="0">
                    </div>
                @endif

                <!-- الصورة -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-image ml-1 text-primary-500"></i>
                        تغيير الصورة
                    </label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full rounded-xl border border-cream-300 p-2">
                </div>

                <!-- رابط الفيديو -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fab fa-youtube ml-1 text-red-500"></i>
                        رابط يوتيوب
                    </label>
                    <input type="url" name="video_link" value="{{ old('video_link', $post->link_video) }}"
                        class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                        placeholder="https://www.youtube.com/watch?v=...">
                </div>

                <!-- ملف الفيديو -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-video ml-1 text-primary-500"></i>
                        ملف فيديو
                    </label>
                    <input type="file" name="video" accept="video/*"
                        class="w-full rounded-xl border border-cream-300 p-2">
                </div>

                <!-- الفيديو الحالي -->
                @if ($post->fileVid)
                    <div class="mb-4">
                        <label class="block text-brown-700 font-medium mb-2">الفيديو الحالي</label>
                        <div class="relative inline-block">
                            <video controls class="max-h-48 rounded-lg" id="currentVideo">
                                <source src="{{ asset('uploads/videos/' . $post->fileVid) }}">
                            </video>
                            <button type="button" onclick="removeVideo()"
                                class="absolute top-2 right-2 bg-red-500 text-white w-8 h-8 rounded-full hover:bg-red-600 transition-colors shadow-lg">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <input type="hidden" name="remove_video" id="removeVideoInput" value="0">
                    </div>
                @endif

                <!-- ملف صوتي -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-headphones ml-1 text-primary-500"></i>
                        ملف صوتي
                    </label>
                    <input type="file" name="audio" accept="audio/*"
                        class="w-full rounded-xl border border-cream-300 p-2">
                </div>

                <!-- الصوت الحالي -->
                @if ($post->fileAud)
                    <div class="mb-4">
                        <label class="block text-brown-700 font-medium mb-2">الملف الصوتي الحالي</label>
                        <div class="relative inline-block w-full max-w-md">
                            <audio controls class="w-full" id="currentAudio">
                                <source src="{{ asset('uploads/audio/' . $post->fileAud) }}">
                            </audio>
                            <button type="button" onclick="removeAudio()"
                                class="mt-2 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-times ml-1"></i>
                                <span>حذف الملف الصوتي</span>
                            </button>
                        </div>
                        <input type="hidden" name="remove_audio" id="removeAudioInput" value="0">
                    </div>
                @endif

                <!-- ملف كتاب -->
                <div class="mb-8">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-book ml-1 text-primary-500"></i>
                        ملف كتاب PDF
                    </label>
                    @if ($post->books)
                        <div class="mb-2 p-3 bg-cream-50 rounded-lg flex items-center justify-between">
                            <span class="text-brown-600">الملف الحالي: {{ $post->books }}</span>
                            <button type="button" onclick="removeBook()"
                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-times ml-1"></i>
                                حذف
                            </button>
                        </div>
                        <input type="hidden" name="remove_book" id="removeBookInput" value="0">
                    @endif
                    <input type="file" name="book" accept=".pdf"
                        class="w-full rounded-xl border border-cream-300 p-2">
                </div>

                <!-- أزرار الإرسال -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-primary-500 text-white py-3 rounded-xl font-bold hover:bg-primary-600 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>حفظ التعديلات</span>
                    </button>
                    <a href="{{ route('home') }}"
                        class="px-6 py-3 border border-cream-300 text-brown-600 rounded-xl hover:bg-cream-100 transition-colors">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script>
        function removeImage() {
            if (confirm('هل أنت متأكد من حذف الصورة؟')) {
                document.getElementById('currentImage').style.display = 'none';
                document.getElementById('removeImageInput').value = '1';
                event.target.closest('.relative').style.display = 'none';
            }
        }

        function removeVideo() {
            if (confirm('هل أنت متأكد من حذف الفيديو؟')) {
                document.getElementById('currentVideo').style.display = 'none';
                document.getElementById('removeVideoInput').value = '1';
                event.target.closest('.relative').style.display = 'none';
            }
        }

        function removeAudio() {
            if (confirm('هل أنت متأكد من حذف الملف الصوتي؟')) {
                document.getElementById('currentAudio').style.display = 'none';
                document.getElementById('removeAudioInput').value = '1';
                event.target.closest('.relative').style.display = 'none';
            }
        }

        function removeBook() {
            if (confirm('هل أنت متأكد من حذف الكتاب؟')) {
                document.getElementById('removeBookInput').value = '1';
                event.target.closest('.mb-2').innerHTML =
                    '<span class="text-red-600"><i class="fas fa-check ml-1"></i>سيتم حذف الكتاب عند الحفظ</span>';
            }
        }
    </script>
@endsection

@extends('layout')

@section('title', 'إضافة منشور جديد - رواق العلوم الشرعية')

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
                        <li class="text-primary-600">إضافة منشور</li>
                    </ol>
                </nav>
                <h1 class="text-2xl md:text-3xl font-bold text-brown-700">إضافة منشور جديد</h1>
            </div>

            <!-- نموذج الإضافة -->
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                @csrf

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
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                        placeholder="أدخل عنوان المنشور" required>
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
                        <option value="">اختر القسم</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
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
                        class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200 resize-none"
                        placeholder="اكتب محتوى المنشور هنا...">{{ old('body') }}</textarea>
                </div>

                <!-- الصورة -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-image ml-1 text-primary-500"></i>
                        صورة المنشور
                    </label>
                    <div
                        class="border-2 border-dashed border-cream-300 rounded-xl p-6 text-center hover:border-primary-400 transition-colors">
                        <input type="file" name="image" accept="image/*" class="hidden" id="imageInput"
                            onchange="previewImage(this)">
                        <label for="imageInput" class="cursor-pointer">
                            <div id="imagePreview" class="hidden mb-4">
                                <img id="previewImg" src="" class="max-h-48 mx-auto rounded-lg">
                            </div>
                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt text-4xl text-cream-400 mb-2"></i>
                                <p class="text-brown-500">اضغط لاختيار صورة</p>
                                <p class="text-sm text-brown-400">PNG, JPG, WEBP (حد أقصى 5MB)</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- رابط الفيديو -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fab fa-youtube ml-1 text-red-500"></i>
                        رابط يوتيوب (اختياري)
                    </label>
                    <input type="url" name="video_link" value="{{ old('video_link') }}"
                        class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                        placeholder="https://www.youtube.com/watch?v=...">
                </div>

                <!-- ملف الفيديو -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-video ml-1 text-primary-500"></i>
                        ملف فيديو (اختياري)
                    </label>
                    <input type="file" name="video" accept="video/*"
                        class="w-full rounded-xl border border-cream-300 p-2">
                </div>

                <!-- ملف صوتي -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-headphones ml-1 text-primary-500"></i>
                        ملف صوتي (اختياري)
                    </label>
                    <input type="file" name="audio" accept="audio/*"
                        class="w-full rounded-xl border border-cream-300 p-2">
                </div>

                <!-- ملف كتاب -->
                <div class="mb-8">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-book ml-1 text-primary-500"></i>
                        ملف كتاب PDF (اختياري)
                    </label>
                    <input type="file" name="book" accept=".pdf"
                        class="w-full rounded-xl border border-cream-300 p-2">
                </div>

                <!-- أزرار الإرسال -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-primary-500 text-white py-3 rounded-xl font-bold hover:bg-primary-600 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>نشر المنشور</span>
                    </button>
                    <a href="{{ route('home') }}"
                        class="px-6 py-3 border border-cream-300 text-brown-600 rounded-xl hover:bg-cream-100 transition-colors">
                        إلغاء
                    </a>
                </div>
            </form>

            <!-- إدارة الأقسام -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-xl font-bold text-brown-700 mb-6 flex items-center gap-2">
                    <i class="fas fa-folder-tree text-primary-500"></i>
                    إدارة الأقسام الحالية
                </h2>

                <!-- قائمة الأقسام -->
                <div class="space-y-4 mb-8">
                    @foreach ($sections as $section)
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between p-4 bg-cream-50 rounded-xl border border-cream-200 gap-4">
                            <form action="{{ route('admin.sections.update', $section->id) }}" method="POST"
                                class="flex-grow flex gap-2 w-full">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $section->name }}"
                                    class="flex-grow rounded-lg border-cream-300 focus:border-primary-500 text-sm py-1.5"
                                    required>
                                <button type="submit"
                                    class="bg-primary-500 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-primary-600 transition-colors">
                                    <i class="fas fa-save ml-1"></i>
                                    حفظ
                                </button>
                            </form>

                            <div class="flex gap-2">
                                <span
                                    class="text-xs text-brown-400 bg-white px-2 py-1.5 rounded-lg border border-cream-200">
                                    {{ $section->posts->count() }} منشور
                                </span>
                                <button type="button"
                                    onclick="confirmDeleteSection({{ $section->id }}, '{{ $section->name }}')"
                                    class="text-red-500 hover:text-red-700 p-1.5 rounded-lg hover:bg-red-50 transition-colors">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <form id="delete-section-{{ $section->id }}"
                                    action="{{ route('admin.sections.destroy', $section->id) }}" method="POST"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="border-cream-200 my-8">

                <h3 class="text-lg font-bold text-brown-700 mb-4">
                    <i class="fas fa-folder-plus ml-2 text-primary-500"></i>
                    إضافة قسم جديد
                </h3>
                <form action="{{ route('admin.sections.store') }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="text" name="name"
                        class="flex-1 rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                        placeholder="اسم القسم الجديد" required>
                    <button type="submit"
                        class="bg-gold-500 text-primary-900 px-6 py-2 rounded-xl font-medium hover:bg-gold-400 transition-colors">
                        إضافة
                    </button>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function confirmDeleteSection(id, name) {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: `سيتم حذف قسم "${name}" وجميع المنشورات العلمية التابعة له نهائياً!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'نعم، احذف الكل',
                    cancelButtonText: 'إلغاء',
                    borderRadius: '1.5rem',
                    customClass: {
                        title: 'font-bold text-brown-700 font-arabic',
                        content: 'text-brown-500'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-section-${id}`).submit();
                    }
                });
            }

            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImg').src = e.target.result;
                        document.getElementById('imagePreview').classList.remove('hidden');
                        document.getElementById('uploadPlaceholder').classList.add('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection

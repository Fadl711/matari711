@extends('layout')

@section('title', 'إضافة منشور جديد - د.محمد بن جميل المطري')

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
                        @foreach ($sections->whereNull('parent_id') as $section)
                            <optgroup label="{{ $section->name }}">
                                <option value="{{ $section->id }}"
                                    {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }} (رئيسي)
                                </option>
                                @foreach ($sections->where('parent_id', $section->id) as $child)
                                    <option value="{{ $child->id }}"
                                        {{ old('section_id') == $child->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;↳ {{ $child->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <!-- المحتوى -->
                <div class="mb-6">
                    <label class="block text-brown-700 font-medium mb-2">
                        <i class="fas fa-file-alt ml-1 text-primary-500"></i>
                        المحتوى
                    </label>
                    <input type="hidden" name="body" id="bodyInput">
                    <div id="quill-editor" style="min-height: 250px; direction: rtl; text-align: right;">
                        {!! old('body') !!}</div>
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

            <!-- إدارة وترتيب الأقسام -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-xl font-bold text-brown-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-folder-tree text-primary-500"></i>
                    إدارة وترتيب الأقسام
                </h2>
                <p class="text-brown-400 text-sm mb-6">استخدم الأسهم ⬆⬇ لتغيير الترتيب (يُحفظ تلقائياً) - عدّل الاسم واضغط
                    حفظ - أو احذف القسم</p>

                <!-- رسالة حفظ الترتيب -->
                <div id="orderSaveStatus"
                    class="hidden mb-4 p-3 bg-green-50 text-green-700 rounded-xl text-sm flex items-center gap-2 transition-all">
                    <i class="fas fa-check-circle"></i>
                    <span>تم حفظ الترتيب بنجاح</span>
                </div>

                <!-- قائمة الأقسام -->
                <div id="sortableSections" class="space-y-3 mb-8">
                    @foreach ($sections->whereNull('parent_id')->sortBy('sort_order') as $section)
                        <div class="sortable-item border border-cream-200 rounded-xl overflow-hidden"
                            data-id="{{ $section->id }}">
                            <!-- القسم الرئيسي -->
                            <div class="flex flex-col sm:flex-row items-center gap-3 p-4 bg-primary-50">
                                <!-- أسهم الترتيب -->
                                <div class="flex sm:flex-col gap-1 order-first">
                                    <button type="button" onclick="moveSection(this, 'up', 'parent')"
                                        title="تحريك لأعلى"
                                        class="text-primary-500 hover:text-primary-700 p-1.5 rounded-lg hover:bg-primary-100 transition-colors">
                                        <i class="fas fa-chevron-up text-sm"></i>
                                    </button>
                                    <button type="button" onclick="moveSection(this, 'down', 'parent')"
                                        title="تحريك لأسفل"
                                        class="text-primary-500 hover:text-primary-700 p-1.5 rounded-lg hover:bg-primary-100 transition-colors">
                                        <i class="fas fa-chevron-down text-sm"></i>
                                    </button>
                                </div>

                                <!-- فورم تعديل الاسم -->
                                <form action="{{ route('admin.sections.update', $section->id) }}" method="POST"
                                    class="flex-grow flex gap-2 w-full items-center">
                                    @csrf
                                    @method('PUT')
                                    <i class="fas fa-folder text-primary-500"></i>
                                    <input type="text" name="name" value="{{ $section->name }}"
                                        class="flex-grow rounded-lg border-cream-300 focus:border-primary-500 text-sm py-1.5 font-bold"
                                        required>
                                    <button type="submit"
                                        class="bg-primary-500 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-primary-600 transition-colors whitespace-nowrap">
                                        <i class="fas fa-save ml-1"></i> حفظ
                                    </button>
                                </form>

                                <!-- معلومات + حذف -->
                                <div class="flex gap-2 items-center">
                                    <span
                                        class="text-xs text-brown-400 bg-white px-2 py-1.5 rounded-lg border border-cream-200 whitespace-nowrap">
                                        {{ $section->posts->count() }} منشور
                                    </span>
                                    <span
                                        class="text-xs text-primary-600 bg-primary-100 px-2 py-1.5 rounded-lg whitespace-nowrap">
                                        {{ $sections->where('parent_id', $section->id)->count() }} فرعي
                                    </span>
                                    <button type="button"
                                        onclick="confirmDeleteSection({{ $section->id }}, '{{ $section->name }}')"
                                        class="text-red-500 hover:text-red-700 p-1.5 rounded-lg hover:bg-red-50 transition-colors">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="delete-section-{{ $section->id }}"
                                        action="{{ route('admin.sections.destroy', $section->id) }}" method="POST"
                                        class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </div>

                            <!-- الأقسام الفرعية -->
                            @if ($sections->where('parent_id', $section->id)->count() > 0)
                                <div class="sub-sections border-t border-cream-200 bg-cream-50 p-3 pr-6 sm:pr-10 space-y-2"
                                    data-parent="{{ $section->id }}">
                                    <p class="text-xs text-brown-400 mb-2"><i class="fas fa-layer-group ml-1"></i> الأقسام
                                        الفرعية:</p>
                                    @foreach ($sections->where('parent_id', $section->id)->sortBy('sort_order') as $child)
                                        <div class="sortable-sub-item flex flex-col sm:flex-row items-center gap-2 p-2 bg-white rounded-lg border border-cream-200"
                                            data-id="{{ $child->id }}">
                                            <!-- أسهم ترتيب فرعي -->
                                            <div class="flex sm:flex-col gap-0.5">
                                                <button type="button" onclick="moveSection(this, 'up', 'child')"
                                                    title="تحريك لأعلى"
                                                    class="text-brown-400 hover:text-primary-600 p-1 rounded hover:bg-primary-50 transition-colors">
                                                    <i class="fas fa-chevron-up text-xs"></i>
                                                </button>
                                                <button type="button" onclick="moveSection(this, 'down', 'child')"
                                                    title="تحريك لأسفل"
                                                    class="text-brown-400 hover:text-primary-600 p-1 rounded hover:bg-primary-50 transition-colors">
                                                    <i class="fas fa-chevron-down text-xs"></i>
                                                </button>
                                            </div>

                                            <!-- فورم تعديل الفرعي -->
                                            <form action="{{ route('admin.sections.update', $child->id) }}"
                                                method="POST" class="flex-grow flex gap-2 w-full items-center">
                                                @csrf @method('PUT')
                                                <i class="fas fa-level-up-alt fa-rotate-90 text-brown-300 text-xs"></i>
                                                <input type="text" name="name" value="{{ $child->name }}"
                                                    class="flex-grow rounded-lg border-cream-300 focus:border-primary-500 text-sm py-1"
                                                    required>
                                                <input type="hidden" name="parent_id" value="{{ $section->id }}">
                                                <button type="submit"
                                                    class="bg-primary-400 text-white px-3 py-1 rounded-lg text-sm hover:bg-primary-500 transition-colors">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </form>

                                            <!-- معلومات + حذف فرعي -->
                                            <div class="flex gap-2 items-center">
                                                <span
                                                    class="text-xs text-brown-400 bg-cream-50 px-2 py-1 rounded-lg border border-cream-200 whitespace-nowrap">
                                                    {{ $child->posts->count() }} منشور
                                                </span>
                                                <button type="button"
                                                    onclick="confirmDeleteSection({{ $child->id }}, '{{ $child->name }}')"
                                                    class="text-red-500 hover:text-red-700 p-1 rounded-lg hover:bg-red-50 transition-colors">
                                                    <i class="fas fa-trash-alt text-sm"></i>
                                                </button>
                                                <form id="delete-section-{{ $child->id }}"
                                                    action="{{ route('admin.sections.destroy', $child->id) }}"
                                                    method="POST" class="hidden">
                                                    @csrf @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <hr class="border-cream-200 my-8">

                <!-- إضافة قسم جديد -->
                <h3 class="text-lg font-bold text-brown-700 mb-4">
                    <i class="fas fa-folder-plus ml-2 text-primary-500"></i>
                    إضافة قسم جديد
                </h3>
                <form action="{{ route('admin.sections.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="text" name="name"
                            class="flex-1 rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                            placeholder="اسم القسم الجديد" required>
                        <select name="parent_id"
                            class="rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200 min-w-[180px]">
                            <option value="">قسم رئيسي</option>
                            @foreach ($sections->whereNull('parent_id') as $parentSection)
                                <option value="{{ $parentSection->id }}">تابع لـ: {{ $parentSection->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="bg-gold-500 text-primary-900 px-6 py-2 rounded-xl font-medium hover:bg-gold-400 transition-colors">
                            إضافة
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <style>
            .ql-editor {
                font-family: 'Tajawal', sans-serif;
                font-size: 16px;
                line-height: 2;
                min-height: 250px;
            }

            .ql-toolbar.ql-snow {
                border-radius: 12px 12px 0 0;
                border-color: #e8e0d4;
                background: #faf7f2;
            }

            .ql-container.ql-snow {
                border-radius: 0 0 12px 12px;
                border-color: #e8e0d4;
            }

            .ql-snow .ql-picker {
                text-align: right;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
            // تهيئة محرر النصوص Quill
            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                placeholder: 'اكتب محتوى المنشور هنا...',
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, 3, false]
                        }],
                        [{
                            'size': ['small', false, 'large', 'huge']
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'align': []
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],
                        ['blockquote'],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            quill.format('direction', 'rtl');
            quill.format('align', 'right');

            // عند إرسال الفورم، انقل المحتوى للـ hidden input
            document.querySelector('form[action*="posts"]').addEventListener('submit', function() {
                document.getElementById('bodyInput').value = quill.root.innerHTML;
            });

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

            // تحريك القسم ثم حفظ تلقائي
            function moveSection(btn, direction, type) {
                const item = btn.closest(type === 'parent' ? '.sortable-item' : '.sortable-sub-item');
                const container = item.parentElement;
                const selector = type === 'parent' ? '.sortable-item' : '.sortable-sub-item';
                const siblings = Array.from(container.querySelectorAll(':scope > ' + selector));
                const index = siblings.indexOf(item);

                let moved = false;
                if (direction === 'up' && index > 0) {
                    container.insertBefore(item, siblings[index - 1]);
                    moved = true;
                } else if (direction === 'down' && index < siblings.length - 1) {
                    if (siblings[index + 1].nextSibling) {
                        container.insertBefore(item, siblings[index + 1].nextSibling);
                    } else {
                        container.appendChild(item);
                    }
                    moved = true;
                }

                // حفظ تلقائي بعد التحريك
                if (moved) {
                    autoSaveOrder();
                }
            }

            // حفظ الترتيب تلقائياً
            function autoSaveOrder() {
                const sections = [];

                // جمع ترتيب الأقسام الرئيسية
                document.querySelectorAll('#sortableSections > .sortable-item').forEach((item, index) => {
                    sections.push({
                        id: parseInt(item.dataset.id),
                        sort_order: index + 1
                    });
                });

                // جمع ترتيب الأقسام الفرعية
                document.querySelectorAll('.sub-sections').forEach(container => {
                    container.querySelectorAll('.sortable-sub-item').forEach((item, index) => {
                        sections.push({
                            id: parseInt(item.dataset.id),
                            sort_order: index + 1
                        });
                    });
                });

                fetch('{{ route('admin.sections.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            sections: sections
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const status = document.getElementById('orderSaveStatus');
                            status.classList.remove('hidden');
                            setTimeout(() => status.classList.add('hidden'), 2000);
                        }
                    })
                    .catch(error => console.error('خطأ في حفظ الترتيب:', error));
            }
        </script>
    @endpush
@endsection

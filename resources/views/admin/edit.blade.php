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
                <input type="text" 
                       name="title" 
                       value="{{ old('title', $post->titleart) }}"
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
                    @foreach($sections as $section)
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
                <textarea name="body" 
                          rows="8"
                          class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200 resize-none">{{ old('body', $post->body) }}</textarea>
            </div>
            
            <!-- الصورة الحالية -->
            @if($post->imgart)
                <div class="mb-4">
                    <label class="block text-brown-700 font-medium mb-2">الصورة الحالية</label>
                    <img src="{{ $post->image }}" alt="" class="max-h-48 rounded-lg">
                </div>
            @endif
            
            <!-- الصورة -->
            <div class="mb-6">
                <label class="block text-brown-700 font-medium mb-2">
                    <i class="fas fa-image ml-1 text-primary-500"></i>
                    تغيير الصورة
                </label>
                <input type="file" 
                       name="image" 
                       accept="image/*"
                       class="w-full rounded-xl border border-cream-300 p-2">
            </div>
            
            <!-- رابط الفيديو -->
            <div class="mb-6">
                <label class="block text-brown-700 font-medium mb-2">
                    <i class="fab fa-youtube ml-1 text-red-500"></i>
                    رابط يوتيوب
                </label>
                <input type="url" 
                       name="video_link" 
                       value="{{ old('video_link', $post->link_video) }}"
                       class="w-full rounded-xl border-cream-300 focus:border-primary-500 focus:ring focus:ring-primary-200"
                       placeholder="https://www.youtube.com/watch?v=...">
            </div>
            
            <!-- ملف الفيديو -->
            <div class="mb-6">
                <label class="block text-brown-700 font-medium mb-2">
                    <i class="fas fa-video ml-1 text-primary-500"></i>
                    ملف فيديو
                </label>
                <input type="file" 
                       name="video" 
                       accept="video/*"
                       class="w-full rounded-xl border border-cream-300 p-2">
                @if($post->fileVid)
                    <p class="text-sm text-brown-400 mt-1">الملف الحالي: {{ $post->fileVid }}</p>
                @endif
            </div>
            
            <!-- ملف صوتي -->
            <div class="mb-6">
                <label class="block text-brown-700 font-medium mb-2">
                    <i class="fas fa-headphones ml-1 text-primary-500"></i>
                    ملف صوتي
                </label>
                <input type="file" 
                       name="audio" 
                       accept="audio/*"
                       class="w-full rounded-xl border border-cream-300 p-2">
                @if($post->fileAud)
                    <p class="text-sm text-brown-400 mt-1">الملف الحالي: {{ $post->fileAud }}</p>
                @endif
            </div>
            
            <!-- ملف كتاب -->
            <div class="mb-8">
                <label class="block text-brown-700 font-medium mb-2">
                    <i class="fas fa-book ml-1 text-primary-500"></i>
                    ملف كتاب PDF
                </label>
                <input type="file" 
                       name="book" 
                       accept=".pdf"
                       class="w-full rounded-xl border border-cream-300 p-2">
                @if($post->books)
                    <p class="text-sm text-brown-400 mt-1">الملف الحالي: {{ $post->books }}</p>
                @endif
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
@endsection

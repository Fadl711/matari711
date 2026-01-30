@extends('layout')
@section('content')
    <!-- Upload Progress Bar Container -->
    <div id="uploadProgressContainer" style="display: none;"
        class="fixed top-0 left-0 right-0 z-50 bg-white shadow-lg border-b-2 border-blue-500">
        <div class="max-w-4xl mx-auto p-4">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span id="uploadFileName" class="text-sm font-medium text-gray-700">جاري الرفع...</span>
                </div>
                <span id="uploadPercentage" class="text-sm font-bold text-blue-600">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div id="uploadProgressBar"
                    class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-300 ease-out"
                    style="width: 0%"></div>
            </div>
            <p id="uploadStatus" class="text-xs text-gray-500 mt-1">يرجى الانتظار...</p>
        </div>
    </div>

    <form method="POST" action="{{ route('posts.update', $posts3->id) }}" id="uploadForm" class="w-1/2 mx-auto "
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="states" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع القسم </label>

        <select id="states" name="typeSection"
            class="cx bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            @foreach ($section as $post)
                <option @selected($posts3->idsection == $post->id) value="{{ $post->id }}">{{ $post->section_Name }}</option>
            @endforeach




        </select>



        <label> </label>
        <label>
            <br>
            <label for="fileImg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة صورة </label>
            <input type="file" id="fileImg" name="fileImg" accept="image/*"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="العنوان" />
            <br>
            <label for="fileVid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة فديوه </label>
            <div class="">

                <input onclick="dis2()" type="button" value="نسخ رابط من اليتيوب"
                    class=" mx-1 transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-300 text-white bg-bro hover:bg-bro/80  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <input onclick="dis1()" type="button" value="اضافة فيديوه من الملفات"
                    class="mx-1 transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-300 text-white bg-bro hover:bg-bro/80  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            </div>
            <br>
            <input type="file" style="display: none" id="fileVid" accept="video/*" name="fileVid"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="العنوان" />
            <input type="text" id="link" name="link_video" style="display: none"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="الرابط">
            <br><label for="fileAud" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة صوت
            </label>
            <input type="file" id="fileAud" accept="audio/*" name="fileAud"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="العنوان" />
            <br>
            {{-- ------------------------------------------- --}}
            <label for="title_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة عنوان
                المقالة</label>
            <input type="text" id="title_art" value="{{ $posts3->title_art }}" name="title_art"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="العنوان" />
            <br>
            <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة محتوى
                المقالة</label>
            <textarea name="body" id="body"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">{{ $posts3->body }}</textarea>

            <br>
            <label for="note_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة ملاحظة
                للمقالة</label>
            <input type="text" id="note_art" name="note_art"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="العنوان" />
            <br>

            <label for="linknote" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> اضافة رابط توجيهي
                للمستخدم</label>
            <input type="text" id="linknote" name="linknote"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="العنوان الرابط" />
            <br>
            <button type="submit" id="submitBtn"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ارسال</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('uploadForm');
            const fileInputs = document.querySelectorAll('input[type="file"]');
            const progressContainer = document.getElementById('uploadProgressContainer');
            const progressBar = document.getElementById('uploadProgressBar');
            const uploadPercentage = document.getElementById('uploadPercentage');
            const uploadFileName = document.getElementById('uploadFileName');
            const uploadStatus = document.getElementById('uploadStatus');
            const submitBtn = document.getElementById('submitBtn');

            // Show file preview when selected
            fileInputs.forEach(input => {
                input.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const fileSize = (file.size / 1024 / 1024).toFixed(2);
                        uploadFileName.textContent = `${file.name} (${fileSize} MB)`;
                    }
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const hasFiles = Array.from(fileInputs).some(input => input.files.length > 0);

                if (!hasFiles) {
                    form.submit();
                    return;
                }

                // Show progress bar
                progressContainer.style.display = 'block';
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

                const xhr = new XMLHttpRequest();

                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        progressBar.style.width = percentComplete + '%';
                        uploadPercentage.textContent = Math.round(percentComplete) + '%';

                        if (percentComplete < 100) {
                            uploadStatus.textContent =
                                `تم رفع ${(e.loaded / 1024 / 1024).toFixed(2)} MB من ${(e.total / 1024 / 1024).toFixed(2)} MB`;
                        } else {
                            uploadStatus.textContent = 'جاري معالجة الملفات...';
                        }
                    }
                });

                xhr.addEventListener('load', function() {
                    if (xhr.status === 200 || xhr.status === 302) {
                        progressBar.classList.remove('bg-gradient-to-r', 'from-blue-500',
                            'to-blue-600');
                        progressBar.classList.add('bg-green-500');
                        uploadStatus.textContent = '✓ تم الرفع بنجاح!';

                        setTimeout(() => {
                            window.location.href = xhr.responseURL || "{{ route('home') }}";
                        }, 500);
                    } else {
                        showError('حدث خطأ أثناء الرفع');
                    }
                });

                xhr.addEventListener('error', function() {
                    showError('فشل الاتصال بالخادم');
                });

                xhr.open('POST', form.action);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.send(formData);
            });

            function showError(message) {
                progressBar.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-blue-600');
                progressBar.classList.add('bg-red-500');
                uploadStatus.textContent = '✗ ' + message;
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });

        // ______________________________________________________-

        function dis1() {

            var mc = document.getElementById("fileVid");
            var mc2 = document.getElementById("link");
            if (mc.style.display == "none") {

                mc.style.display = "block";
                if (mc2.style.display == "block") {
                    mc2.style.display = "none";

                }
            } else if (mc.style.display == "block") {
                mc.style.display = "none";
            }
        }


        function dis2() {
            var mc = document.getElementById("fileVid");
            var mc2 = document.getElementById("link");
            if (mc2.style.display == "none") {
                mc2.style.display = "block";
                if (mc.style.display == "block") {
                    mc.style.display = "none";
                }

            } else mc2.style.display = "none";
        }
    </script>
@endsection

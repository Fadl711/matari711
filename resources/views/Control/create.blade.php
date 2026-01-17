@extends('layout')
@section('content')
    <br>
    <div class="">
        <button onclick="disSection()" id="seci" class=" btnSection ">اضافة قسم</button>
        <button onclick="disSection1()" id="seci1" class="btnSection">اضافة منشور</button>
    </div>
    <br><br>
    <form method="POST" action="{{ route('Control.store') }}" id="form1" style="display:none" class="w-1/2 mx-auto "
        enctype="multipart/form-data">
        @csrf
        <label for="section" class="sr-only">اسم القسم</label>
        <input type="text" id="" name="sectionName"
            class=" my-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="اسم القسم ... " required />
        <button type="submit"
            class="text-white bg-bro hover:bg-bro/80 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">انشاء</button>
    </form>
    <form method="POST" action="{{ route('posts.store') }}" id="form2" style="display:none" class="w-1/2 mx-auto "
        enctype="multipart/form-data">
        @csrf
        <label for="states" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع القسم </label>
        <select id="states" name="typeSection"
            class="cx bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>اختار قسم</option>
            @foreach ($section as $sec)
                <option name="ids" value="{{ $sec['id'] }} "> {{ $sec['section_Name'] }}</option>
            @endforeach
        </select>
        <label> </label>
        <br>
        <br>
        {{-- ------------------------------------------- --}}
        <label for="title_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة عنوان
            المقالة</label>
        <input type="text" id="title_art" name="title_art" class="btninput" placeholder="عنوان المقالة" />
        <br>
        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة محتوى
            المقالة</label>
        <textarea name="body" id="body" class="btninput" "></textarea>
        <br>
        <label for="fileImg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة صورة </label>
        <input type="file" id="fileImg" name="fileImg" accept="image/*" class="btninput" placeholder="العنوان" />
        <label for="book" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة كتاب </label>
        <input type="file" id="book" name="book" accept="pdf/*" class="btninput" placeholder="العنوان" />
        <br>
        <label for="fileVid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة فديوه</label>
        <div class="">
            <input onclick="dis2()" type="button" value="نسخ رابط من اليوتيوب" class=" btnSection">
            <input onclick="dis1()" type="button" value="اضافة فيديوه من الملفات" class="btnSection">
        </div>
        <br>
        <input type="file" style="display: none" id="fileVid" accept="video/*" name="fileVid" class="btninput"
            placeholder="العنوان" />
        <input type="text" id="link" name="link_video" style="display: none" class="btninput" placeholder="الرابط">
        <br><label for="fileAud" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة صوت </label>
        <input type="file" id="fileAud" accept="audio/*" name="fileAud" class="btninput" placeholder="العنوان" />
        <label for="note_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة ملاحظة
            للمقالة</label>
        <input type="text" id="note_art" name="note_art" class="btninput" placeholder="العنوان" />
        <br>
        <label for="note_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> اضافة رابط توجيهي
            للمستخدم</label>
        <input type="text" id="note_art" name="note_art" class="btninput" placeholder="العنوان الرابط" />
        <br>
        <button type="submit"
            class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">اضافة</button>
    </form>
@endsection
<script src="{{url('/assets/js/my_js.js')}}"></script>

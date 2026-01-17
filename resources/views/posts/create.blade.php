@extends('layout')
@section('title')
Home
@endsection
@section('content')


<form method="POST" action="{{route('posts.store')}}"  enctype="multipart/form-data">
 @csrf
<label for="states" class="sr-only">Choose a state</label>

        <select id="states" name="teypsection" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="Choose" selected>Choose a state</option>
         
        </select>
<label for="fileImg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >اضافة  صورة للمقالة</label>
      <input type="file" id="fileImg"  name="fileImg" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
      <br>
      <label for="titleart" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة  عنوان المقالة</label>
      <input type="text" id="titleart"  name="title_art" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
      <br>
      <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة محتوى المقالة</label>
      <textarea name="body"  id="body" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  value=" "></textarea>

      <br>
      <label for="note_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة  ملاحظة للمقالة</label>
      <input type="text" id="note_art"  name="note_art" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
      <br>

      <label for="link_note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">  اضافة رابط توجيهي للمستخدم</label>
      <input type="text" id="linknote"  name="link_note" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان الرابط"  />
      <br>
    <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ارسال</button>
  </form>



    @endsection

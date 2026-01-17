@extends('layout')
@section('content')




<form  method="POST" action="{{route('posts.update',$posts3->id)}}" id="form2"  class="w-1/2 mx-auto " enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="states" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع القسم </label>

    <select id="states" name="typeSection" class="cx bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

        @foreach($section as $post)
    <option  @selected ($posts3->idsection == $post->id) value="{{$post->id}}">{{$post->section_Name}}</option>


            @endforeach




        </select>



        <label> </label>
        <label>
        <br>
<label for="fileImg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >اضافة  صورة </label>
      <input type="file" id="fileImg"  name="fileImg"  accept="image/*" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
<br>
      <label for="fileVid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >اضافة  فديوه </label>
<div class="">

    <input onclick="dis2()" type="button" value="نسخ رابط من اليتيوب"  class=" mx-1 transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-300 text-white bg-bro hover:bg-bro/80  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <input onclick="dis1()" type="button" value="اضافة فيديوه من الملفات" class="mx-1 transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-300 text-white bg-bro hover:bg-bro/80  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
</div>
<br>
<input type="file"  style="display: none" id="fileVid" accept="video/*"  name="fileVid" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
<input type="text" id="link"  name="link_video"  style="display: none" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="الرابط"  >
<br><label for="fileAud" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >اضافة  صوت </label>
      <input type="file"   id="fileAud" accept="audio/*" name="fileAud" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
      <br>
      {{-- ------------------------------------------- --}}
      <label for="title_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة  عنوان المقالة</label>
      <input type="text" id="title_art" value="{{$posts3->title_art}}"  name="title_art" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
      <br>
      <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة محتوى المقالة</label>
      <textarea name="body"  id="body" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  >{{$posts3->body}}</textarea>

      <br>
      <label for="note_art" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اضافة  ملاحظة للمقالة</label>
      <input type="text" id="note_art"  name="note_art" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان"  />
      <br>

      <label for="linknote" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">  اضافة رابط توجيهي للمستخدم</label>
      <input type="text" id="linknote"  name="linknote" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="العنوان الرابط"  />
      <br>
    <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ارسال</button>
  </form>

  <script>


/*
    function disSection1()
    {;
var mc2=document.getElementById("form2");
    if(mc2.style.display=="none"){
        mc2.style.display="block";

}else mc2.style.display="none";
}
 */

// ______________________________________________________-

function dis1()
    {

var mc=document.getElementById("fileVid");
var mc2=document.getElementById("link");
    if(mc.style.display=="none"){

    mc.style.display="block";
    if(mc2.style.display=="block"){
        mc2.style.display="none";

    }
}

else if(mc.style.display=="block"){
    mc.style.display="none";
}
}


    function dis2()
    {
var mc=document.getElementById("fileVid");
var mc2=document.getElementById("link");
    if(mc2.style.display=="none"){
        mc2.style.display="block";
        if(mc.style.display=="block"){
            mc.style.display="none";
}

}else mc2.style.display="none";
}

    </script>
@endsection

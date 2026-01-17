<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeTextController extends Controller
{
   public function getTextBetweenWords($text, $startWord, $endWord)
    {
      $startPos = strpos($text, $startWord);
      if ($startPos === false) {
        return ''; // الكلمة البداية غير موجودة
      }
      $startPos += strlen($startWord); // تجاوز الكلمة البداية

      $endPos = strpos($text, $endWord, $startPos);
      if ($endPos === false) {
        return ''; // الكلمة النهاية غير موجودة
      }

      $length = $endPos - $startPos;
      return substr($text, $startPos, $length);
    }
}

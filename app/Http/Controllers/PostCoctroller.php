<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostCoctroller extends Controller
{


  public function  welcome()
  {
    return view('posts.welcome');
  }

  public function  create()
  {
    return view('posts.create');
  }
  public function store(Request $request)
  {
    $data = new Post;
    $title_art = $request->title_art;
    $body = $request->body;
    $note_art = $request->note_art;
    $link_note = $request->link_note;
    $typeSection = $request->typeSection;
    $idsection = $request->idsection;
    if (isset($request->fileImg)) {
        $image = $request->fileImg;
            $path = 'images/' . $image->getClientOriginalName();
            Storage::disk('r2')->put($path, file_get_contents($image),'public');

      $url = Storage::disk('r2')->url($path);

/*       $path = "book";
      $request->fileImg->move($path, $file_book); */
      $data->imgart = $url;
    }

    if (isset($request->fileVid)) {
      $file22 =  $request->fileVid->getClientOriginalExtension();
      $file_Vid = time() . '.' . $file22;
      $path = "book";
      $request->fileVid->move($path, $file_Vid);
      $data->fileVid = $file_Vid;
    } else if (isset($request->link_video)) {

      $text = $request->link_video;
      $startWord = 'e/';
      $endWord = '?s';
        $rr = new GeTextController();

      $result = $rr->getTextBetweenWords($text, $startWord, $endWord);
      $data->link_video = $result;
    }

    if (isset($request->fileAud)) {
      $file22 = $request->fileAud->getClientOriginalExtension();
      $file_aud = time() . '.' . $file22;
      $path = "book";
      $request->fileAud->move($path, $file_aud);
      $data->fileAud = $file_aud;
    }
    if (isset($request->book)) {
      $file_b = $request->book->getClientOriginalExtension();
      $file_book = time() . '.' . $file_b;
      $path = "book";
      $request->book->move($path, $file_book);
      $data->books = $file_book;
    }
    $data->titleart = $title_art;
    $data->body = $body;
    $data->noteart = $note_art;
    $data->linknote = $link_note;
    $data->teypsection = $typeSection;
    $data->idsection = $typeSection;
    $data->userid = auth()->user()->id;
    $data->save();

    return  to_route('posts.show_all', $typeSection);
  }

  public function storeUser(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      /* 'password' => ['required', 'confirmed', Rules\Password::defaults()], */
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      /* 'password' => Hash::make($request->password), */
    ]);


    return redirect(route('posts.welcome', ['session' => $request->email]));
  }
  public function destroy($id)
  {
    Post::find($id)->delete();
    return to_route('posts.welcome');
  }
  public function edit($id)
  {
    $posts3 = Post::find($id);
    return view('posts.edit', compact('posts3'));
  }
  public function update(Request $request, $id)
  {
    $data = Post::find($id);
    $title_art = $request->title_art;
    $body = $request->body;
    $note_art = $request->note_art;
    $link_note = $request->link_note;
    $typeSection = $request->typeSection;

    if (isset($request->fileImg)) {
      $file_i =  $request->fileImg->getClientOriginalExtension();
      $file_book = time() . '.' . $file_i;
      $path = "book";
      $request->fileImg->move($path, $file_book);
      $data->update([
        'imgart' => $file_book,
      ]);
    }

    if (isset($request->fileVid)) {
      $file_v =  $request->fileVid->getClientOriginalExtension();
      $file_Vid = time() . '.' . $file_v;
      $path = "book";
      $request->fileVid->move($path, $file_Vid);
      $data->update([
        'fileVid' => $file_Vid,
      ]);
    } else if (isset($request->link_video)) {

      $text = $request->link_video;
      $startWord = 'e/';
      $endWord = '?s';

      $rr = new GeTextController();

      $result = $rr->getTextBetweenWords($text, $startWord, $endWord);

      $data->update([
        'link_video' => $result,
      ]);
    }

    if (isset($request->fileAud)) {
      $file_a = $request->fileAud->getClientOriginalExtension();
      $file_aud = time() . '.' . $file_a;
      $path = "book";
      $request->fileAud->move($path, $file_aud);
      $data->update([
        'fileAud' => $file_aud,
      ]);
    }
    if (isset($request->book)) {
      $file_b = $request->book->getClientOriginalExtension();
      $file_book = time() . '.' . $file_b;
      $path = "book";
      $request->book->move($path, $file_book);
      $data->update([
        'books' => $file_book,
      ]);
    }
    $data->update([
      'titleart' => $title_art,
      'body' => $body,
      'noteart' => $note_art,
      'linknote' => $link_note,
      'teypsection' => $typeSection,
      'idsection' => $typeSection,

    ]);

    return to_route('posts.welcome');
  }
}

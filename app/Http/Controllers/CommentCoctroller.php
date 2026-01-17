<?php

namespace App\Http\Controllers;

use App\Events\NewCommentPosted;
use App\Events\NewReplyPosted;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Request;
use LDAP\Result;

use function Laravel\Prompts\alert;

class CommentCoctroller extends Controller
{


    public function comment(Request $request,$id){

        $user_id=$request->user_id;

    $comment=$request->comment;
        $reply=Comment::create([
        'comment'=>$comment,
        'post_id'=>$id,
        'user_id'=>$user_id,
    ]);
    session()->forget('comment_text');
        $reply->load('user');

        event(new NewCommentPosted($reply));
        /*         event(new NewCommentPosted($reply));
 */
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => $request->comment,
                'user_name' => auth()->user()->name,
                'user_img' => auth()->user()->img ? url('img/' . auth()->user()->img) : url('R.png')
            ]);
        }
/*     return to_route('posts.show',$id); */







      }



    public function likes(Request $request, $id){
     $user_id=$request->user_id;
     $data=Like::where('post_id',$id)->where('user_id', $user_id)->first();
     if(isset($data)){
        $data->delete();

       /*  Like::where('post_id',$id)->where('user_id',$user_id)->delete(); */




     }else
     {
        Like::create([
            'user_id'=>$user_id,
            'print_like'=>1,
            'post_id'=>$id
        ]);
     }








            /* $data::where('user_id',$user_id)->first(); */



/* if(Like::where('post_id',$id)->doesntExist()){


        }
 */



return  to_route('posts.show',$id) ;

}
}

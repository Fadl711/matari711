<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     */
   /*  public function show(Request $request, string $id): View
    {
        $value = $request->session()->get('key');

        // ...

        $user = $this->users->find($id);


    } */
public function update( Request $request ,$id){
    User::find($id)->update([
'usertype'=>$request->usertype,
    ]);
return back();


}

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'img' => ['nullable', 'image', 'max:800'],
        ]);
        if (isset($request->img)) {
            $file_i =  $request->img->getClientOriginalExtension();
            $imgfile = time() . '.' . $file_i;
            $path = "img";
            $request->img->move($path, $imgfile);
          }else {
            // إذا لم تكن الصورة موجودة، تعيين قيمة null
            $imgfile = null;
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'img'=>$imgfile ,
        ]);

        event(new Registered($user));

        Auth::login($user);
        $redirectUrl  =session('redirect_to');
        session(['comment_text' => session('comment_text')]);
        return redirect("/");

    }
}

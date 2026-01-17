<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // حفظ الرابط السابق مع مرجع الـ #comment_input
            $redirectUrl = url()->previous() . '#comment_input';

            // تخزين الرابط في الجلسة
            session(['redirect_to' => $redirectUrl]);
            session(['comment_text' => $request->input('comment')]);

            return redirect()->route('register');
        }

        return $next($request);
    }
}

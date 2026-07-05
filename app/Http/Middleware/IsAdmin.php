<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // បន្ទាត់នេះហើយដែលខ្វះមុននេះ!
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // ពិនិត្យមើលថាបើ User បាន Login ហើយមានសិទ្ធិជា Admin
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // បើមិនមែនជា Admin ទេ បញ្ជូនទៅកាន់ទំព័រដើមវិញ
        return redirect('/')->with('error', 'អ្នកមិនមានសិទ្ធិចូលកាន់ទំព័រនេះទេ។');
    }
}
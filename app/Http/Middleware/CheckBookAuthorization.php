<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBookAuthorization
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();
        $urlParams = explode("/", $path);

        $bookId = null;
        for ($i = 0; $i < count($urlParams); $i++) {
            if($urlParams[$i] === 'books') {
                $bookId = $urlParams[$i + 1];
            }
        }

        dd($bookId);
        $book = $request->route('book');

        if (Auth::user()->cannot('update', $book)) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized action');
        }

        return $next($request);
    }
}

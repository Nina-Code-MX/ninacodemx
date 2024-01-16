<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['message' => 'Unaunthenticated'], 401);
        }

        $token = explode(' ', $request->header('Authorization'));

        if ($token[0] != 'NinaCode') {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $user = User::select('users.id')
            ->join("personal_access_tokens", "personal_access_tokens.tokenable_id", "=", "users.id")
            ->whereRaw(DB::raw("`personal_access_tokens`.`token` = '" . $token['1'] . "'"))
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        Auth::loginUsingId($user->id);
        $request->user()->activeToken = $token['1'];

        return $next($request);
    }
}

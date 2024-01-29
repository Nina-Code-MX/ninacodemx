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

        $token = explode('|', $token[1]);
        $token_id = $token[0];
        $token_hash = hash('sha256', $token[1]);

        $user = User::select('users.id')
            ->join("personal_access_tokens", "personal_access_tokens.tokenable_id", "=", "users.id")
            ->whereRaw(DB::raw("`personal_access_tokens`.`id` = '" . $token_id . "'"))
            ->whereRaw(DB::raw("`personal_access_tokens`.`token` = '" . $token_hash . "'"))
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        Auth::loginUsingId($user->id);
        $request->user()->withAccessToken($token_hash);

        return $next($request);
    }
}

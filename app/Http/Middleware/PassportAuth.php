<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;

class PassportAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Extract the token
        $token = $request->bearerToken();

        // Get the user ID linked to this token
        $tokenData = DB::table('oauth_access_tokens')->where('id', hash('sha256', $token))->first();

        return response()->json([$request->bearerToken(), decrypt($token), $token], 401);

        if (!$tokenData || $tokenData->revoked) {
            return response()->json(['error' => 'Unauthorized. Invalid or revoked token.'], 401);
        }

        // Check if the token has expired
        if (Carbon::parse($tokenData->expires_at)->isPast()) {
            return response()->json(['error' => 'Unauthorized. Token expired.'], 401);
        }

        return $next($request);
    }
}

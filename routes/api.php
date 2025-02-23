<?php

use App\Http\Controllers\Api\ClientRegisterationController;
use App\Http\Controllers\Api\TeamsRegisterationController;
use App\Http\Middleware\PassportAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(
    function () {
        Route::middleware('auth:api')->get('/user', function (Request $request) {
            return ["alpha" => "beta", 'user' => Auth::guard('api')->user()];
            return $request->user();
        });

        Route::prefix('integration')->group(function () {
            Route::prefix('teams')->group(function () {
                Route::post('new', [TeamsRegisterationController::class, 'index']);
                Route::prefix('client')->group(function () {
                    Route::post('new', [ClientRegisterationController::class, 'index']);
                });
            });
        });
    }
);

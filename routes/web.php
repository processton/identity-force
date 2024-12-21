<?php

use App\Http\Controllers\Central\SetupController;
use Illuminate\Support\Facades\Route;



foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::prefix('tenant')->group(function () {
            Route::get('/', [SetupController::class, 'store']);
        });
    });
}

<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Configurations\ConfigurationsController;
use App\Http\Controllers\Admin\ConnectedApps\ConnectedAppsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ConnectedApps\OAuthController;
use App\Http\Controllers\Admin\ConnectedApps\SAMLController;
use App\Http\Controllers\Admin\ConnectedApps\SocialConnectionsController;
use App\Http\Controllers\Admin\TeamsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhatsNext;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {


    Route::get('/', function () {
        return redirect('whats-next');
    });

    Route::prefix('admin')->middleware([
        'auth',
        'verified',
        'tenant_admin',
    ])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/teams', [TeamsController::class, 'index'])->name('teams');

        Route::prefix('/users')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('admin.users');
            Route::get('/invite', [UsersController::class, 'invite'])->name('admin.users.invite');
            Route::get('/blocked', [UsersController::class, 'blocked'])->name('admin.users.blocked');
            Route::get('/black-list', [UsersController::class, 'blackList'])->name('admin.users.black_list');
            Route::post('/', [UsersController::class, 'store'])->name('admin.users.store');
            Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
            Route::patch('/{user}', [UsersController::class, 'update'])->name('admin.users.update');
            Route::delete('/{user}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
        });

        Route::prefix('/connected-apps')->group(function () {

            Route::get('/', [ConnectedAppsController::class, 'index'])->name('admin.connected-apps');
            Route::prefix('/o-auth-2-0')->group(function () {
                Route::get('/', [OAuthController::class, 'index'])->name('admin.oauth');
            });
            Route::prefix('/saml')->group(function () {
                Route::get('/', [SAMLController::class, 'index'])->name('admin.saml');
            });
            Route::prefix('/socialite')->group(function () {
                Route::get('/', [SocialConnectionsController::class, 'index'])->name('admin.socialite');
            });

        });

        Route::prefix('/configurations')->group(function () {
            Route::get('/', [ConfigurationsController::class, 'index'])->name('admin.configurations');
            Route::post('/', [ConfigurationsController::class, 'update'])->name('admin.configurations.update');
            Route::post('/logo', [ConfigurationsController::class, 'uploadLogo'])->name('admin.configurations.logo');

            Route::get('/theme', [ConfigurationsController::class, 'theme'])->name('admin.configurations.theme');
            Route::get('/teams', [ConfigurationsController::class, 'teams'])->name('admin.configurations.teams');
            Route::get('/mfa', [ConfigurationsController::class, 'mfa'])->name('admin.configurations.mfa');
            Route::get('/admin-identificaiton', [ConfigurationsController::class, 'adminIdentificaiton'])->name('admin.configurations.admin-identificaiton');
            Route::get('/email-servers', [ConfigurationsController::class, 'emailServers'])->name('admin.configurations.email-servers');
            Route::get('/embed', [ConfigurationsController::class, 'embed'])->name('admin.configurations.embed');

        });
    });

    Route::get('/whats-next', [WhatsNext::class, 'index'])->name('whats-next');

    Route::middleware('auth')->group(function () {

        Route::prefix('profile')->group(function (){

            Route::get('/', [ProfileController::class, 'index'])->name('profile');
            Route::get('/basic', [ProfileController::class, 'basic'])->name('profile.basic');
            Route::get('/login_and_security', [ProfileController::class, 'loginAndSecurity'])->name('profile.login_security');
            Route::get('/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
            Route::get('/billing_and_payments', [ProfileController::class, 'billingAndPayments'])->name('profile.billing_payments');

            Route::prefix('/edit')->group(function (){
                Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
                Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
            });

            Route::post('picture', [ProfileController::class, 'profilePicture'])->name('profile.picture');

        });








    });

    require __DIR__.'/auth.php';

});

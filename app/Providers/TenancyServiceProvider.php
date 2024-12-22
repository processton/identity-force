<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Controllers\Auth\CustomAuthorizationController;
use App\Http\Middleware\OAuthAuthorizr;
use App\Models\OAuth\AuthCode;
use App\Models\OAuth\Client;
use App\Models\OAuth\PersonalAccessClient;
use App\Models\OAuth\RefreshToken;
use App\Models\OAuth\Token;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Passport;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Events;
use Stancl\Tenancy\Jobs;
use Stancl\Tenancy\Listeners;
use Stancl\Tenancy\Middleware;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class TenancyServiceProvider extends ServiceProvider
{
    // By default, no namespace is used to support the callable array syntax.
    public static string $controllerNamespace = '';

    public function events()
    {
        return [
            // Tenant events
            Events\CreatingTenant::class => [],
            Events\TenantCreated::class => [
                JobPipeline::make([
                    Jobs\CreateDatabase::class,
                    Jobs\MigrateDatabase::class,
                    // Jobs\SeedDatabase::class,

                    // Your own jobs to prepare the tenant.
                    // Provision API keys, create S3 buckets, anything you want!

                ])->send(function (Events\TenantCreated $event) {
                    return $event->tenant;
                })->shouldBeQueued(false), // `false` by default, but you probably want to make this `true` for production.
            ],
            Events\SavingTenant::class => [],
            Events\TenantSaved::class => [],
            Events\UpdatingTenant::class => [],
            Events\TenantUpdated::class => [],
            Events\DeletingTenant::class => [],
            Events\TenantDeleted::class => [
                JobPipeline::make([
                    Jobs\DeleteDatabase::class,
                ])->send(function (Events\TenantDeleted $event) {
                    return $event->tenant;
                })->shouldBeQueued(false), // `false` by default, but you probably want to make this `true` for production.
            ],

            // Domain events
            Events\CreatingDomain::class => [],
            Events\DomainCreated::class => [],
            Events\SavingDomain::class => [],
            Events\DomainSaved::class => [],
            Events\UpdatingDomain::class => [],
            Events\DomainUpdated::class => [],
            Events\DeletingDomain::class => [],
            Events\DomainDeleted::class => [],

            // Database events
            Events\DatabaseCreated::class => [],
            Events\DatabaseMigrated::class => [],
            Events\DatabaseSeeded::class => [],
            Events\DatabaseRolledBack::class => [],
            Events\DatabaseDeleted::class => [],

            // Tenancy events
            Events\InitializingTenancy::class => [],
            Events\TenancyInitialized::class => [
                Listeners\BootstrapTenancy::class,
            ],

            Events\EndingTenancy::class => [],
            Events\TenancyEnded::class => [
                Listeners\RevertToCentralContext::class,
            ],

            Events\BootstrappingTenancy::class => [],
            Events\TenancyBootstrapped::class => [],
            Events\RevertingToCentralContext::class => [],
            Events\RevertedToCentralContext::class => [],

            // Resource syncing
            Events\SyncedResourceSaved::class => [
                Listeners\UpdateSyncedResource::class,
            ],

            // Fired only when a synced resource is changed in a different DB than the origin DB (to avoid infinite loops)
            Events\SyncedResourceChangedInForeignDatabase::class => [],
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->bootEvents();
        $this->mapRoutes();

        $this->makeTenancyMiddlewareHighestPriority();
        $this->loadTenancyConfigurations();
        $this->registerTenancyPassport();

    }

    protected function bootEvents()
    {
        foreach ($this->events() as $event => $listeners) {
            foreach ($listeners as $listener) {
                if ($listener instanceof JobPipeline) {
                    $listener = $listener->toListener();
                }

                Event::listen($event, $listener);
            }
        }
    }

    protected function mapRoutes()
    {
        $this->app->booted(function () {
            if (file_exists(base_path('routes/tenant.php'))) {
                Route::namespace(static::$controllerNamespace)
                    ->group(base_path('routes/tenant.php'));
            }
            if (file_exists(base_path('routes/embed.php'))) {
                Route::namespace(static::$controllerNamespace)
                    ->group(base_path('routes/embed.php'));
            }
        });
    }

    protected function makeTenancyMiddlewareHighestPriority()
    {
        $tenancyMiddleware = [
            // Even higher priority than the initialization middleware
            Middleware\PreventAccessFromCentralDomains::class,

            Middleware\InitializeTenancyByDomain::class,
            Middleware\InitializeTenancyBySubdomain::class,
            Middleware\InitializeTenancyByDomainOrSubdomain::class,
            Middleware\InitializeTenancyByPath::class,
            Middleware\InitializeTenancyByRequestData::class,
        ];

        foreach (array_reverse($tenancyMiddleware) as $middleware) {
            $this->app[\Illuminate\Contracts\Http\Kernel::class]->prependToMiddlewarePriority($middleware);
        }
    }

    protected function loadTenancyConfigurations()
    {

        \Stancl\Tenancy\Features\TenantConfig::$storageToConfigMap = [
            'theme' => 'config.theme',
            'name' => 'config.name',
            'logo' => 'config.logo',
            'registeration_enabled' => 'config.registeration.enabled',
            'registeration_email_verification' => 'config.registeration.email_verification',
            'teams_enabled' => 'config.teams.enabled',
            'teams_limit_total' => 'config.teams.limit.total',
            'teams_limit_members' => 'config.teams.limit.members',
            'teams_limit_per_user' => 'config.teams.limit.per_user',
            'mfa_policy' => 'config.mfa.policy',
            'mfa_providers_google' => 'config.mfa.providers.google',
            'mfa_providers_email' => 'config.mfa.providers.email',
            'mfa_providers_sms' => 'config.mfa.providers.sms',
            'admin_identification' => 'config.admin.identification',
            'admin_in' => 'config.admin.in',
            'embed_enabled' => 'config.embed.enabled',
            'embed_login' => 'config.embed.login',
            'embed_register' => 'config.embed.register',
            'embed_forgot_password' => 'config.embed.forgot_password',
            'passport_public_key' => 'passport.public_key',
            'passport_private_key' => 'passport.private_key',
            'mailer_driver' => 'config.mailer.driver',
            'mailer_from_name' => 'config.mailer.from_name',
            'mailer_from_address' => 'config.mailer.from_address',
            'mailer_host' => 'config.mailer.host',
            'mailer_port' => 'config.mailer.port',
            'mailer_username' => 'config.mailer.username',
            'mailer_password' => 'config.mailer.password',
            'mailer_encryption' => 'config.mailer.encryption',
            'socialite_facebook' => 'config.socialite.facebook.enabled',
            'socialite_facebook_client_id' => 'config.socialite.facebook.client_id',
            'socialite_facebook_client_secret' => 'config.socialite.facebook.client_secret',
            'socialite_facebook_redirect' => 'config.socialite.facebook.redirect',
            'socialite_google' => 'config.socialite.google.enabled',
            'socialite_google_client_id' => 'config.socialite.google.client_id',
            'socialite_google_client_secret' => 'config.socialite.google.client_secret',
            'socialite_google_redirect' => 'config.socialite.google.redirect',
            'socialite_twitter' => 'config.socialite.twitter.enabled',
            'socialite_twitter_client_id' => 'config.socialite.twitter.client_id',
            'socialite_twitter_client_secret' => 'config.socialite.twitter.client_secret',
            'socialite_twitter_redirect' => 'config.socialite.twitter.redirect',
            'socialite_linkedin' => 'config.socialite.linkedin.enabled',
            'socialite_linkedin_client_id' => 'config.socialite.linkedin.client_id',
            'socialite_linkedin_client_secret' => 'config.socialite.linkedin.client_secret',
            'socialite_linkedin_redirect' => 'config.socialite.linkedin.redirect',


        ];
    }

    protected function registerTenancyPassport(){

        Route::group([
            'as' => 'passport.',
            'middleware' => [
                InitializeTenancyByDomain::class, // Use tenancy initialization middleware of your choice
                PreventAccessFromCentralDomains::class
            ],
            'prefix' => config('passport.path', 'oauth'),
            'namespace' => 'Laravel\Passport\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . "/../../vendor/laravel/passport/src/../routes/web.php");
            Route::middleware([
                'web',
                'auth',
                OAuthAuthorizr::class
                ])->group(function () {
                    Route::get('/authorize', [AuthorizationController::class, 'authorize']);
            });
        });

        Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::useTokenModel(Token::class);
        Passport::useRefreshTokenModel(RefreshToken::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useClientModel(Client::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

    }
}

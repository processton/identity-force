<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationsRequest;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{

    // protected $mappings = [
            // 'theme' => config('config.theme'),
            // 'name' => config('config.name'),
    //         'logo' => config('config.logo'),
    //         'registeration_enabled' => config('config.registeration.enabled'),
    //         'registeration_email_verification' => config('config.registeration.email_verification'),
    //         'teams_enabled' => config('config.teams.enabled'),
    //         'teams_limit_total' => config('config.teams.limit.total'),
    //         'teams_limit_members' => config('config.teams.limit.members'),
    //         'teams_limit_per_user' => config('config.teams.limit.per_user'),
    //         'mfa_policy' => config('config.mfa.policy'),
    //         'mfa_providers_google' => config('config.mfa.providers.google'),
    //         'mfa_providers_email' => config('config.mfa.providers.email'),
    //         'mfa_providers_sms' => config('config.mfa.providers.sms'),
    //         'admin_identification' => config('config.admin.identification'),
    //         'admin_in' => config('config.admin.in'),
    //         'embed_enabled' => config('config.embed.enabled'),
    //         'embed_login' => config('config.embed.login'),
    //         'embed_register' => config('config.embed.register'),
    //         'embed_forgot_password' => config('config.embed.forgot_password'),
    // ];

    public function index()
    {
        return view('admin.configurations.basic',[
            'logo' => config('config.logo'),
            'name' => config('config.name'),
        ]);
    }

    public function theme()
    {
        $themes = collect([
                ...config('themes.free'),
                ...config('themes.premium'),
            ])->map(function($theme){
                return [
                    'label' => $theme['title'],
                    'key' => $theme['views'],
                ];
            });
        return view('admin.configurations.theme', [
            'theme' => config('config.theme'),
            'themes' => $themes->toArray(),
        ]);
    }

    public function embed(){
        return view('admin.configurations.embed', [
            'embed_enabled' => config('config.embed.enabled'),
            'embed_login' => config('config.embed.login'),
            'embed_register' => config('config.embed.register'),
            'embed_forgot_password' => config('config.embed.forgot_password'),
        ]);
    }

    public function teams(){
        // dd(config('config.teams'));
        return view('admin.configurations.teams', [
            'teams_enabled' => config('config.teams.enabled'),
            'teams_limit_total' => config('config.teams.limit.total'),
            'teams_limit_members' => config('config.teams.limit.members'),
            'teams_limit_per_user' => config('config.teams.limit.per_user'),
        ]);
    }

    public function mfa(){

        return view('admin.configurations.mfa', [
            'mfa_policy' => config('config.mfa.policy'),
            'mfa_policies' => [
                [
                    'key' => 'disabled',
                    'label' => 'Disabled',
                ],
                [
                    'key' => 'relaxed',
                    'label' => 'Optional',
                ],
                [
                    'key' => 'enforced',
                    'label' => 'Enforced',
                ],
                [
                    'key' => 'restricted',
                    'label' => 'Restricted',
                ]
            ],
            'mfa_providers_google' => config('config.mfa.providers.google'),
            'mfa_providers_email' => config('config.mfa.providers.email'),
            'mfa_providers_sms' => config('config.mfa.providers.sms'),
        ]);
    }

    public function adminIdentificaiton(){
        return view('admin.configurations.admin-identificaiton', [
            'identifications' => [
                [
                    'key' => 'email',
                    'label' => 'Emails',
                ],
                [
                    'key' => 'team',
                    'label' => 'Teams',
                ],
            ],
            'admin_identification' => config('config.admin.identification'),
            'admin_in' => is_string($in = config('config.admin.in')) ? $in : implode(',', $in),
        ]);
    }

    public function emailServers(){
        return view('admin.configurations.email-servers',[
            'mailer_driver' => config('config.mailer.driver'),
            'mailer_drivers' => [
                [
                    'key' => 'smtp',
                    'label' => 'SMTP',
                ],
                [
                    'key' => 'mailgun',
                    'label' => 'Mailgun',
                ],
                [
                    'key' => 'sendgrid',
                    'label' => 'Sendgrid',
                ],
                [
                    'key' => 'ses',
                    'label' => 'SES',
                ]
            ],
            'mailer_host' => config('config.mailer.host'),
            'mailer_port' => config('config.mailer.port'),
            'mailer_user' => config('config.mailer.user'),
            'mailer_password' => config('config.mailer.password'),
            'mailer_encryption' => config('config.mailer.encryption'),
            'mailer_from_address' => config('config.mailer.address'),
            'mailer_from_name' => config('config.mailer.from'),
        ]);
    }

    public function uploadLogo(){

    }

    public function update(ConfigurationsRequest $request)
    {
        $config = $request->validated();
        $configItems = array_keys($request->rules());
        $data = [];
        foreach ($config as $key => $value) {

            if(in_array($key, $configItems)){

                $data[$key] = $value;

            }

        }
        tenant()->update($data);

        return response()->json(['message' => 'Configuration updated successfully']);

    }
}

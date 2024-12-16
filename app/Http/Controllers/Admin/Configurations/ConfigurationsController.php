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
                    'key' => $theme['title'],
                    'label' => $theme['views'],
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
                    'label' => 'Required',
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

    public function uploadLogo(){

    }

    public function update(ConfigurationsRequest $request)
    {
        $config = $request->validated();
        $configItems = [
            'theme',
            'name',
            'logo',
            'registeration_enabled',
            'registeration_email_verification',
            'teams_enabled',
            'teams_limit_total',
            'teams_limit_members',
            'teams_limit_per_user',
            'mfa_policy',
            'mfa_providers_google',
            'mfa_providers_email',
            'mfa_providers_sms',
            'admin_identification',
            'admin_in',
            'embed_enabled',
            'embed_login',
            'embed_register',
            'embed_forgot_password'
        ];
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

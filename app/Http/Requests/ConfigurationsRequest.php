<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'theme' => ['nullable', 'string', 'max:256'],
            'name' => ['nullable', 'string', 'max:256'],
            'logo' => ['nullable', 'string', 'max:256'],
            'registeration_enabled' => ['nullable', 'boolean', 'max:1'],
            'registeration_email_verification' => ['nullable', 'boolean', 'max:1'],
            'teams_enabled' => ['nullable', 'boolean', 'max:1'],
            'teams_limit_total' => ['nullable', 'int'],
            'teams_limit_members' => ['nullable', 'int'],
            'teams_limit_per_user' => ['nullable', 'int'],
            'mfa_policy' => ['nullable', 'string', 'max:256'],
            'mfa_providers_google' => ['nullable', 'boolean', 'max:1'],
            'mfa_providers_email' => ['nullable', 'boolean', 'max:1'],
            'mfa_providers_sms' => ['nullable', 'boolean', 'max:1'],
            'admin_identification' => ['nullable', 'string', 'in:email,team'],
            'admin_in' => ['nullable', 'string', 'max:256'],
            'embed_enabled' => ['nullable', 'boolean', 'max:1'],
            'embed_login' => ['nullable', 'boolean', 'max:1'],
            'embed_register' => ['nullable', 'boolean', 'max:1'],
            'embed_forgot_password' => ['nullable', 'boolean', 'max:1'],
            'mailer_driver' => ['nullable', 'string', 'max:256'],
            'mailer_from_name' => ['nullable', 'string', 'max:256'],
            'mailer_from_address' => ['nullable', 'string', 'max:256'],
            'mailer_host' => ['nullable', 'string', 'max:256'],
            'mailer_port' => ['nullable', 'int'],
            'mailer_username' => ['nullable', 'string', 'max:256'],
            'mailer_password' => ['nullable', 'string', 'max:256'],
            'mailer_encryption' => ['nullable', 'string', 'max:256'],

        ];
    }
}

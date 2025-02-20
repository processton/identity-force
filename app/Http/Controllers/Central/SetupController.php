<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Tenant;
use Illuminate\Http\Request;
use phpseclib\Crypt\RSA as LegacyRSA;
use phpseclib3\Crypt\RSA;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SetupController extends Controller
{
    public function store(Request $request) : \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'id' => 'required|string|unique:tenants,id',
            'name' => 'required',
            'domain' => 'required|string',
            'theme' => 'nullable|string',
            'admin_email' => 'required|string|email',
            'admin_name' => 'required|string',
            'tenancy_db_name' => 'required|string',
            'tenancy_db_username' => 'required|string',
            'tenancy_db_password' => 'required|string',
            'MAX_TEAMS' => 'required',
            'MAX_USERS' => 'required',
            'ADMIN_EMAILS' => 'required|string',
            'ADMIN_TEAM_NAME' => 'required|string',
            'ADMIN_IDENTIFIED_BY' => 'required|string'
        ]);

        if (class_exists(LegacyRSA::class)) {

            $keys = (new LegacyRSA)->createKey(4096);

            $data['passport_public_key'] = Arr::get($keys, 'publickey');
            $data['passport_private_key'] = Arr::get($keys, 'privatekey');

        } else {
            $key = RSA::createKey(4096);

            $data['passport_public_key'] =  (string) $key->getPublicKey();
            $data['passport_private_key'] = (string) $key;
        }

        try{

            $tenant = Tenant::create([
                'id' => $data['id'],
                'name' => $data['name'],
                'theme' => $data['theme'] ?? 'default',
                'passport_public_key' => $data['passport_public_key'],
                'passport_private_key' => $data['passport_private_key'],
                'admin_name' => $data['admin_name'],
                'admin_email' => $data['admin_email'],
                'tenancy_db_name' => $data['tenancy_db_name'],
                'tenancy_db_username' => $data['tenancy_db_username'],
                'tenancy_db_password' => $data['tenancy_db_password'],
                'teams_enabled' => true,
                'teams_limit_total' => $data['MAX_TEAMS'],
                'teams_limit_members' => 0,
                'teams_limit_per_user' => 3,
                'admin_identification' => $data['ADMIN_IDENTIFIED_BY'],
                'admin_in' => $data['ADMIN_IDENTIFIED_BY'] == 'Team' ? $data['ADMIN_TEAM_NAME'] : $data['ADMIN_EMAILS'],

            ]);

            $tenant->domains()->create([
                'domain' => $data['domain'],
            ]);

            return response()->json($tenant->only([
                'id', 'name'
            ]),201);

        }catch(\Exception $e){

            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}

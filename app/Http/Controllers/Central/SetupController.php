<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Tenant;
use Illuminate\Http\Request;
use phpseclib\Crypt\RSA as LegacyRSA;
use phpseclib3\Crypt\RSA;
use Illuminate\Support\Arr;

class SetupController extends Controller
{
    public function store(Request $request) : \Illuminate\Http\JsonResponse
    {

        $data = $request->validate([
            'id' => 'required|string|unique:tenants,id',
            'domain' => 'required|string',
            'theme' => 'nullable|string',
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

        $tenant = Tenant::create([
            'id' => $data['id'],
            'theme' => $data['theme'] ?? 'default',
            'passport_public_key' => $data['passport_public_key'],
            'passport_private_key' => $data['passport_private_key'],
        ]);

        $tenant->domains()->create([
            'domain' => $data['domain'],
        ]);

        return response()->json($tenant);
    }
}

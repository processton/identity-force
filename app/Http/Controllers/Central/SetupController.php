<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Tenant;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function store(Request $request) : \Illuminate\Http\JsonResponse
    {

        $data = $request->validate([
            'id' => 'required|string|unique:tenants,id',
            'domain' => 'required|string',
        ]);

        $tenant = Tenant::create([
            'id' => $data['id'],
        ]);

        $tenant->domains()->create([
            'domain' => $data['domain'],
        ]);

        return response()->json($tenant);
    }
}

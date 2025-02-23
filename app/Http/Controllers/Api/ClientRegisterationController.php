<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConnectedApp;
use Illuminate\Http\Request;

class ClientRegisterationController extends Controller
{
    public function index(Request $request)
    {

        $data = $request->validate([
            'connected_app_id' => 'required',
            'call_back' => 'required',
        ]);


        $data = $request->validate([
            'call_back' => 'required',
            'connected_app_id' => 'required',
        ]);

        $connectedApp = ConnectedApp::findOrFail($data['connected_app_id']);

        $client = app('Laravel\Passport\ClientRepository')->create(null, $connectedApp->name, $data['call_back']);

        $client->connected_app_id = $connectedApp->id;

        $client->user_id = $connectedApp->user_id;

        $client->team_id = $connectedApp->team_id;

        $client->provider = 'oauth2';

        $client->personal_access_client = false;

        $client->password_client = false;

        $client->revoked = false;

        $client->save();

        return response()->json([
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'client_url' => route('home'). '/oauth/authorize',
        ], 201);


    }
}

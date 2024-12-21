<?php

namespace App\Http\Controllers\Admin\ConnectedApps;

use App\Http\Controllers\Controller;
use App\Models\ConnectedApp;
use App\Models\OAuth\Client;
use Illuminate\Http\Request;

class OAuthController extends Controller
{

    public function store(Request $request)
    {
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


        return redirect()->route('admin.connected-apps.view',['id' => $connectedApp->id]);
    }

    public function update($id)
    {
        $client = Client::findOrFail($id);

        $data = request()->validate([
            'call_back' => 'required',
        ]);

        $client->redirect = $data['call_back'];

        $client->save();

        return redirect()->route('admin.connected-apps.view',['id' => $client->connected_app_id]);
    }


}

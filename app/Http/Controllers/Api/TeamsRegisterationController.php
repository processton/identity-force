<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConnectedApp;
use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Http\Request;

class TeamsRegisterationController extends Controller
{
    public function index(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'admin_name' => 'required|string',
            'admin_email' => 'required|email',
            'create_connected_app' => 'required|boolean',
            'call_back' => 'nullable|url',
        ]);


        $team = Team::create([
            'name' => $data['name'],
        ]);

        $user = User::firstOrNew([
            'email' => $data['admin_email'],
        ],[
            'name' => $data['admin_name'],
        ]);

        UserTeam::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'role' => 'admin'
        ]);


        if($data['create_connected_app']){

            $connectedApp = ConnectedApp::create([
                'name' => $team->name,
                'type' => 'team',
            ]);

            $connectedApp->team_id = $team->id;
            $connectedApp->user_id = $user->id;
            $connectedApp->save();

            if(array_key_exists('call_back', $data) && $data['call_back']){

                $client = app('Laravel\Passport\ClientRepository')->create(null, $connectedApp->name, $data['call_back']);

                $client->connected_app_id = $connectedApp->id;

                $client->user_id = $connectedApp->user_id;

                $client->team_id = $connectedApp->team_id;

                $client->provider = 'oauth2';

                $client->personal_access_client = false;

                $client->password_client = false;

                $client->revoked = false;

                $client->save();
            }
        }

        return response()->json([
            'message' => 'Team created successfully',
            'team' => $team,
            'app' => isset($connectedApp) ? [
                ...$connectedApp->toArray(),
                'client' => isset($client) ? [
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'client_url' => route('home') . '/oauth/authorize',
                ] : []
            ] : []
        ], 201);


    }
}

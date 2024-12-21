<?php

namespace App\Http\Controllers\Admin\ConnectedApps;

use App\Http\Controllers\Controller;
use App\Models\ConnectedApp;
use App\Models\Team;
use Illuminate\Http\Request;

class ConnectedAppsController extends Controller
{

    public function index()
    {
        $paginated = ConnectedApp::paginate(10);

        return view('admin.connected_apps.list', [
            'connected_apps' => $paginated,
        ]);
    }

    public function create()
    {
        return view('admin.connected_apps.create',[
            'types' => [
                'general' => 'General',
                'team' => 'Team',
            ],
            'teams' => Team::all()->pluck('name', 'id'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'team_id' => 'required_if:type,team',
        ]);

        ConnectedApp::create($request->only('name', 'type', 'team_id'));

        return redirect()->route('admin.connected-apps');
    }

    public function show($id)
    {

        $connected_app = ConnectedApp::with('oAuthClients')->findOrFail($id);

        return view('admin.connected_apps.show',[
            'connected_app' => $connected_app,
        ]);
    }

    public function edit($id)
    {

        $connected_app = ConnectedApp::findOrFail($id);

        return view('admin.connected_apps.edit',[
            'connected_app' => $connected_app,
            'types' => [
                'general' => 'General',
                'team' => 'Team',
            ],
            'teams' => Team::all()->pluck('name', 'id'),
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'team_id' => 'required_if:type,team',
        ]);

        $connected_app = ConnectedApp::findOrFail($id);

        $connected_app->update($request->only('name', 'type', 'team_id'));

        return redirect()->route('admin.connected-apps');

    }
}

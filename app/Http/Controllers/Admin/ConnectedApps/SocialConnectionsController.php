<?php

namespace App\Http\Controllers\Admin\ConnectedApps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialConnectionsController extends Controller
{

    public function index()
    {
        return view('admin.connected_apps.socialite.list',[
            'allowed_method' => [
                [
                    'name' => 'Facebook',
                    'method' => 'facebook',
                    'icon' => 'fa-brands fa-facebook text-blue-600',
                    'callback' => route('callback.socialite',['method' => 'facebook']),
                    'description' => 'Connect with Facebook'
                ],
                [
                    'name' => 'Google',
                    'method' => 'google',
                    'icon' => 'fa-brands fa-google text-red-600',
                    'callback' => route('callback.socialite',['method' => 'google']),
                    'description' => 'Connect with Google'
                ],
                [
                    'name' => 'Twitter',
                    'method' => 'twitter',
                    'icon' => 'fa-brands fa-twitter text-blue-400',
                    'callback' => route('callback.socialite',['method' => 'twitter']),
                    'description' => 'Connect with Twitter'
                ],
                [
                    'name' => 'LinkedIn',
                    'method' => 'linkedin',
                    'icon' => 'fa-brands fa-linkedin text-blue-800',
                    'callback' => route('callback.socialite',['method' => 'linkedin']),
                    'description' => 'Connect with LinkedIn'
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'method' => 'required',
            'client_id' => 'nullable',
            'client_secret' => 'nullable',
        ]);

        $allowed = [
            'facebook',
            'google',
            'twitter',
            'linkedin'
        ];

        if(!in_array($data['method'], $allowed)){
            abort(404);
        }
        $enable = true;

        if($data['client_id'] == null || $data['client_secret'] == null){
            $enable = false;
        }

        $config = [
            'socialite_'.$data['method'] => $enable,
            'socialite_'.$data['method'].'_client_id' => $data['client_id'],
            'socialite_'.$data['method'].'_client_secret' => $data['client_secret'],
            'socialite_'.$data['method'].'_redirect' => route('callback.socialite',['method' => $data['method']]),
        ];

        tenant()->update($config);

        return redirect()->back()->with('success','Social connection '.$data['method'].' updated successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin\ConnectedApps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SAMLController extends Controller
{

    public function index()
    {
        return view('admin.connected_apps.saml.list');
    }
}

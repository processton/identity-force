<?php

namespace App\Http\Controllers\Admin\ConnectedApps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConnectedAppsController extends Controller
{

    public function index()
    {
        return redirect()->route('admin.oauth');
    }
}

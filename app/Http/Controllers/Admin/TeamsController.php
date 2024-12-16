<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index()
    {
        $paginated = Team::paginate(10);

        return view('admin.teams', [
            'teams' => $paginated
        ]);
    }
}

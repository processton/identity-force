<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {

        $paginated = User::paginate(10);
        // dd($paginated);
        return view('admin.users.list',[
            'users' => $paginated
        ]);
    }
}

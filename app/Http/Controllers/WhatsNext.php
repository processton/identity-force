<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsNext extends Controller
{
    public function index(Request $request)
    {
        if($request->user->is_admin){
            return redirect('dashboard');
        }else{
            return redirect('profile');
        }
    }
}

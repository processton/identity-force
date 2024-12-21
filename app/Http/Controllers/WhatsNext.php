<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhatsNext extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check()){

            if($request->user()->is_admin){
                return redirect(route('admin.dashboard'));
            }else{
                return redirect(route('profile'));
            }
        }else{
            return redirect(route('login'));
        }
    }
}

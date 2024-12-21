<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteRedirectController extends Controller
{

    private $allowed = [
            'facebook'
    ];

    public function redirectToSocialite($method, Request $request)
    {
        if(in_array($method, $this->allowed)){
            return Socialite::driver($method)->redirect();
        }
        abort(404);
    }

    public function callbackFromSocialite($method, Request $request)
    {

        if(in_array($method, $this->allowed)){
            
            $providerUser = Socialite::driver($method)->user();

            $user = User::updateOrCreate([
                $method.'_id' => $providerUser->id,
            ], [
                'name' => $providerUser->name,
                'email' => $providerUser->email,
                $method.'_token' => $providerUser->token,
                $method.'_refresh_token' => $providerUser->refreshToken,
            ]);
        
            Auth::login($user);
        
            return redirect('/dashboard');
        }
        abort(404);

    }
}

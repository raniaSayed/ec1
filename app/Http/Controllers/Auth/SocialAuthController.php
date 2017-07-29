<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Socialite;
use App\User;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
		    $user = Socialite::driver($provider)->user();
		} catch (\GuzzleHttp\Exception\ClientException $e) {
		    dd('there is some thing error, please try again later.');
		}

		// check if provider id or email founded in database don't create new record
        $authUser = User::
        	where('provider_id', $user->id)->
        	orWhere('email', $user->email)->
        	first();

        if($authUser == null) {
        	$authUser = new User;

        	$authUser->name = $user->name;
	        $authUser->email = $user->email;
	        $authUser->provider_id = $user->id;
	        $authUser->provider = $provider;

	        $authUser->save();
        }

        auth()->login($authUser);
        return redirect('/');
    }
}

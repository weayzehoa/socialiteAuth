<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialAccountService;
use Session;

class SocialController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect($request)
    {
        Session::put('provider', $request);
        return Socialite::driver($request)->redirect();
    }
    /**
    * Return a callback method from facebook api.
    *
    * @return callback URL from facebook
    */
    public function callback(SocialAccountService $service)
    {
        $provider = Session::get('provider');
        $user = $service->createOrGetUser(Socialite::driver($provider)->user());
        auth()->login($user);
        return redirect()->to('/home');
    }
}

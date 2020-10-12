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
     * Create a redirect method to provider api.
     * 利用 Session 來傳遞 provider 變數
     */
    public function redirect($request)
    {
        Session::put('provider', $request);
        return Socialite::driver($request)->redirect();
    }
    /**
    * Return a callback method from provider api.
    * 透過 Session 找出 provider 變數並提供給 Socialite Class 使用
    * @return callback URL from provider
    */
    public function callback(SocialAccountService $service)
    {
        $provider = Session::get('provider');
        $user = $service->createOrGetUser(Socialite::driver($provider)->user());
        auth()->login($user);
        return redirect()->to('/home');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Google_Client;
use Google_Service_People;
use Illuminate\Support\Facades\Storage;
use League\OAuth1\Client\Credentials\Credentials;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {

        return Socialite::driver('google')
            //->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
            ->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('login');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser                    = new User;
            $newUser->provider_name     = 'google';
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar            = $user->getAvatar();
            $newUser->save();

            auth()->login($newUser, true);
        }


        // $credentials = Storage::disk('local')->url("credentials.json");

        // $google_client_token = [
        //     'access_token' => $user->token,
        //     'refresh_token' => $user->refreshToken,
        //     'expires_in' => $user->expiresIn
        // ];

        // $client = new Google_Client();
        // $client->setApplicationName('TinyNotes');
        // $client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));
        // $client->setAccessToken(json_encode($google_client_token));

        // $service = new Google_Service_People($client);

        // $optParams = array('requestMask.includeField' => 'person.phone_numbers,person.names,person.email_addresses');
        // $results = $service->people_connections->listPeopleConnections('people/me', $optParams);

        // dd($results);

        return redirect($this->redirectPath());
    }
}

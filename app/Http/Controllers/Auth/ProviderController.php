<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use TheSeer\Tokenizer\Exception;

class ProviderController extends Controller
{
    public function redirect($provider){

        return Socialite::driver($provider)->redirect();


    }

    public function callback($provider)
    {



        try {
            $socialUser = Socialite::driver($provider)->user();

            if (User::where('email', $socialUser->getEmail())->exists()) {
                return redirect('/login')->withErrors(['email' => 'This email uses a different method to login.']);
            }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $socialUser->id,
            ])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'username' => User::generateUserName($socialUser->getNickname()),
                    'provider' => $provider, // Fixed the typo here ('provider' > $provider)
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    'email_verified_at' => now(),
                ]);

                Auth::login($user);

                return 44;
            }
        } catch (Exception $e) {
            // Handle exceptions if needed
            return redirect('/login')->withErrors(['error' => 'An error occurred during authentication.']);
        }
    }

}

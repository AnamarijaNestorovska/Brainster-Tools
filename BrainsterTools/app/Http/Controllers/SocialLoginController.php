<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class SocialLoginController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();


    }

    // public function callback(string $provider)
    // {
    //     $socialUser = Socialite::driver($provider)->stateless()->redirect();


    //     if(User::where('email', '=', $socialUser->email)->first()){
    //         $checkUser = User::where('email', '=', $socialUser->email)->first();
    //         Auth::login($checkUser);
    //         return redirect('home');
    //          }

    //         $provider->facebook_id = $socialUser->getId();
    //         $provider->name = $socialUser->getName();
    //         $provider->email = $socialUser->getEmail();
    //         $provider->avatar = $socialUser->getAvatar();
    //         $provider->save();

    //         Auth::login($provider);
    //         return redirect('home');


    // }

    public function callback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();
        // dd($socialUser);
        $name = $socialUser->name;

        if($socialUser->name == null) {
            $name = $socialUser->nickname;
        }

        $user = User::firstOrCreate(
            [
                'email' => $socialUser->email,
            ],
            [
                'name' => $name,

                'is_admin' => 0
            ]
        );

        auth()->login($user);

        return redirect()->route('index');
    }


}

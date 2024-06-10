<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController
{
    public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect()
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            // Логирование данных от GitHub
            Log::info('GitHub User:', (array)$githubUser);

            // Проверка наличия email
            if (!$githubUser->email) {
                return redirect('/login')->withErrors('Email not provided by GitHub.');
            }

            // Обработка отсутствующего имени
            $name = $githubUser->name ?? $githubUser->nickname ?? 'Unnamed';

            $user = User::updateOrCreate(
                ['github_id' => $githubUser->id],
                [
                    'name' => $name,
                    'email' => $githubUser->email,
                    'password' => bcrypt('password') // Или управляйте паролем, как вам удобно
                ]
            );

            Auth::login($user, true);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Логирование ошибок
            Log::error('GitHub OAuth Error: ' . $e->getMessage());
            return redirect('/login')->withErrors('Authentication failed, please try again.');
        }
    }
    public function google(){
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Логирование данных от GitHub
            Log::info('Google User:', (array)$googleUser);

            // Проверка наличия email
            if (!$googleUser->email) {
                return redirect('/login')->withErrors('Email not provided by GitHub.');
            }

            // Обработка отсутствующего имени
            $name = $googleUser->name ?? $googleUser->nickname ?? 'Unnamed';

            $user = User::updateOrCreate(
                [
                    'name' => $name,
                    'email' => $googleUser->email,
                    'password' => bcrypt('password') // Или управляйте паролем, как вам удобно
                ]
            );

            Auth::login($user, true);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Логирование ошибок
            Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect('/login')->withErrors('Authentication failed, please try again.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService)
    {
 
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $result = $this->userService->handleOAuthUser($googleUser);

        Auth::login($result['user']);

        if ($result['status'] === 'created') {
            return redirect()->route('profile.edit');
        }
        
        return redirect('/dashboard');
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Laravel\Socialite\Contracts\User as ContractsUser;

/**
 * Class UserService.
 */
class UserService
{
    public function handleOAuthUser(ContractsUser $oauthUserData)
    {
        $user = User::updateOrCreate(
            ['email' => $oauthUserData->email],
            [
                'name' => $oauthUserData->name,
                'email' => $oauthUserData->email,
                'google_id' => $oauthUserData->id,
                'google_token' => $oauthUserData->token,
                'google_refresh_token' => $oauthUserData->refreshToken,
            ]
        );
        $status = $user->wasRecentlyCreated ? 'created' : 'updated';

        return [
            'user' => $user,
            'status' => $status,
        ];
    }
}

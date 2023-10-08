<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Hash;
use Auth;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthenticationProviderController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     */
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);

        if (!is_null($validated)) {
            return $validated;
        }

        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail(),
                'google_id' => $user->getId(),
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

        // Log the user in
        Auth::login($userCreated);

        // Success Response
        return response()->json([
            'message' => 'User registered successfully',
            'success' => true,
            'user' => $userCreated,
        ], 201);
    }

    /**
     * @param $provider
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['google'])) {
            return response()->json(['error' => 'Please login using google'], 422);
        }
    }
}
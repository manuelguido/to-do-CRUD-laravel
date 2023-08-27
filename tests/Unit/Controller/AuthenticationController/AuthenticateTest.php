<?php

namespace Tests\Unit\Controller\AuthenticationController;

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Requests\AuthenticateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class AuthenticateTest extends TestCase
{
    use WithFaker;

    /**
     * IMPORTANT:
     * 
     * AuthenticateRequest is manually validated because Laravel bypasses any FormRequest
     * or Middleware when calling a function from a controller directly.
     * 
     * Generate a new instance of the AuthenticateRequest.
     * 
     * @param array $formData
     * @return \App\Http\Requests\AuthenticateRequest;
     */
    private function generateRequest($formData): AuthenticateRequest
    {
        return new AuthenticateRequest([
            'email' => $formData['email'],
            'password' => $formData['password'],
        ]);
    }

    /**
     * Execute a validator instance with the provided request and return it.
     *
     * @param \App\Http\Requests\AuthenticateRequest;
     * @return \Illuminate\Validation\Validator.
     */
    private function executeValidator($request): Validator
    {
        return app('validator')->make($request->all(), $request->rules());
    }

    /**
     * Authenticate a user with valid credentials.
     *
     * @return void.
     */
    public function test_authenticate_with_valid_credentials()
    {
        // User credentials
        $formData = [
            'email' => $this->faker->safeEmail(),
            'password' => $this->faker->password(8),
        ];

        // Create a new user
        User::factory()->create([
            'email' => $formData['email'],
            'password' => bcrypt($formData['password']),
        ]);

        // Create a new RegisterRequest and validate
        $request = $this->generateRequest($formData);
        $validator = $this->executeValidator($request);

        if (!$validator->fails()) {
            // AuthenticationController instance
            $controller = new AuthenticationController();

            // Call controller's register method
            $response = $controller->authenticate($request);

            // Assert that the response is a JsonResponse
            $this->assertInstanceOf(JsonResponse::class, $response);

            // Assert that the response has a 201 response code
            $this->assertEquals(200, $response->getStatusCode());
        }
    }

    /**
     * Attemp to authenticate a user with invalid credentials.
     *
     * @return void.
     */
    public function test_authenticate_with_invalid_credentials()
    {
        // New credentials
        $formData = [
            'email' => null,
            'password' => null,
        ];

        // Create a new RegisterRequest and validate
        $request = $this->generateRequest($formData);
        $validator = $this->executeValidator($request);

        // AuthenticationController instance
        $controller = new AuthenticationController();

        // Call controller's authenticate method
        $response = $controller->authenticate($request);

        // Assert that validator fails
        $this->assertTrue($validator->fails());
        // Assert that the response is a JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);
        // Assert that the response has 200 response code
        $this->assertEquals(401, $response->getStatusCode());
    }
}

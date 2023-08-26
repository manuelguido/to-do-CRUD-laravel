<?php

namespace Tests\Unit\Controller\AuthenticationController;

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;
use Tests\TestCase;

class RegisterTest extends TestCase
{
  use DatabaseTransactions;
  use WithFaker;

  /**
   * IMPORTANT:
   * 
   * RegisterRequest is manually validated because Laravel bypasses any FormRequest
   * or Middleware when calling a function from a controller directly.
   * 
   * Generate a new instance of the RegisterRequest.
   * 
   * @param array $formData
   * @return \App\Http\Requests\RegisterRequest;
   */
  private function generateRequest($formData): RegisterRequest
  {
    return new RegisterRequest([
      'name' => $formData['name'],
      'email' => $formData['email'],
      'password' => $formData['password'],
    ]);
  }

  /**
   * Execute a validator instance with the provided request and return it.
   *
   * @param \App\Http\Requests\RegisterRequest $request.
   * @return \Illuminate\Validation\Validator.
   */
  private function executeValidator($request): Validator
  {
    return app('validator')->make($request->all(), $request->rules());
  }

  /**
   * Register a new user with valid data.
   *
   * @return void.
   */
  public function test_register_with_valid_credentials(): void
  {
    // New credentials
    $formData = [
      'name' => $this->faker->name(),
      'email' => $this->faker->safeEmail(),
      'password' => $this->faker->password(8),
    ];

    // Create a new RegisterRequest and validate
    $request = $this->generateRequest($formData);
    $validator = $this->executeValidator($request);

    if (!$validator->fails()) {
      // AuthenticationController instance
      $controller = new AuthenticationController();

      // Call controller's register method
      $response = $controller->register($request);

      // Assert that the response is a JsonResponse
      $this->assertInstanceOf(JsonResponse::class, $response);

      // Assert that the response has a 201 response code
      $this->assertEquals(201, $response->getStatusCode());

      // Assert that the user was created in the database
      $this->assertDatabaseHas('users', [
        'name' => $formData['name'],
        'email' => $formData['email'],
      ]);
    }
  }

  /**
   * Register a new user with invalid data.
   *
   * @return void.
   */
  public function test_register_with_invalid_credentials(): void
  {
    // New credentials
    $formData = [
      'name' => null,
      'email' => null,
      'password' => null,
    ];

    // Create a new RegisterRequest and validate
    $request = $this->generateRequest($formData);
    $validator = $this->executeValidator($request);

    $this->assertTrue($validator->fails());
  }
}
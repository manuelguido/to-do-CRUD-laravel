<?php

namespace Tests\Feature\TodoItem;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TodoItemStoreTest extends TestCase
{
	use RefreshDatabase;

	private $apiEndpoint = '/api/todo-item';
	private $todoItemName;
	private $user;

	/**
	 * Test setup.
	 * 
	 * @return void.
	 */
	protected function setUp(): void
	{
		// Parent setup
		parent::setUp();

		// Create a user and authenticate
		$this->user = User::factory()->create();
		$this->actingAs($this->user);

		// Generate random name to store as todo item
		$this->todoItemName = Str::random(10);
	}

	/**
	 * Store endpoint returns JSON response.
	 * 
	 * @return void.
	 */
	public function testStoreTodoItemReturnsJsonResponse(): void
	{
		// Make a GET request to the index endpoint
		$response = $this->postJson($this->apiEndpoint, [
			"name" => $this->todoItemName,
		]);

		// Assert response is Json
		$this->assertJson($response->getContent());
		$response->assertHeader('Content-Type', 'application/json');
	}

	/**
	 * Store endpoint returns 201 HTTP code.
	 * 
	 * @return void.
	 */
	public function testStoreTodoItemReturns201Code(): void
	{
		// Make a GET request to the index endpoint
		$response = $this->postJson($this->apiEndpoint, [
			"name" => $this->todoItemName,
		]);

		// Assert response is Json
		$response->assertStatus(201);
	}

	/**
	 * Store endpoint saves information into database.
	 * 
	 * @return void.
	 */
	public function testStoreTodoItemSavesInformationIntoDatabase(): void
	{
		// Make a POST request to the store endpoint
		$this->postJson($this->apiEndpoint, [
			"name" => $this->todoItemName,
		]);

		// Assert the to-do item has been created
		$this->assertDatabaseHas('todo_items', [
			'name' => $this->todoItemName,
			'user_id' => $this->user->getAttribute("id"),
		]);
	}
}
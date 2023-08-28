<?php

namespace Tests\Feature\TodoItem;

use App\Models\ToDoItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TodoItemIndexTest extends TestCase
{
	use RefreshDatabase;

	private $apiEndpoint = '/api/todo-item';
	private $todoItems;

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
		$user = User::factory()->create();
		$this->actingAs($user);

		// Create some Todo Items for the user.
		$this->todoItems = ToDoItem::factory(5)->create([
			'name' => Str::random(10),
			'user_id' => $user->getAttribute("id"),
		]);
	}	

	/**
	 * Index endpoint returns JSON response.
	 * 
	 * @return void.
	 */
	public function testIndexTodoItemReturnsJsonResponse(): void
	{
		// Make a GET request to the index endpoint
		$response = $this->getJson($this->apiEndpoint);

		// Assert response is Json
		$this->assertJson($response->getContent());
		$response->assertHeader('Content-Type', 'application/json');
	}

	/**
	 * Index endpoint returns 200 HTTP code when authenticated.
	 * 
	 * @return void.
	 */
	public function testIndexTodoItemReturns200CodeWhenAuthenticated(): void
	{
		// Make a GET request to the index endpoint
		$response = $this->getJson($this->apiEndpoint);

		// Assert response is Json
		$response->assertStatus(200);
	}

	/**
	 * Index endpoint returns correct amount of items.
	 * 
	 * @return void.
	 */
	public function testIndexTodoItemReturnsCorrectAmountOfTodoItems(): void
	{
		// Make a GET request to the index endpoint
		$response = $this->getJson($this->apiEndpoint);

		// Assert amount of created elements
		$response->assertJsonCount(5);
	}

	/**
	 * Index endpoint returns correct information.
	 * 
	 * @return void.
	 */
	public function testIndexTodoItemReturnsCorrectInformation(): void
	{
		// Make a GET request to the index endpoint
		$response = $this->getJson($this->apiEndpoint);

		// Assert first element of todoItems
		$response->assertJsonFragment([
			'name' => $this->todoItems[0]->name,
			'user_id' => $this->todoItems[0]->user_id,
		]);
	}
}
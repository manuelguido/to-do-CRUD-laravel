<?php

namespace Tests\Feature\TodoItem;

use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TodoItemDeleteTest extends TestCase
{
	use RefreshDatabase;

	private $apiEndpoint;
	private $todoItemToDelete;

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

		// Create a todo item to delete
		$this->todoItemToDelete = TodoItem::factory()->create([
			'name' => Str::random(10),
			'user_id' => $user->getAttribute("id"),
		]);

		$this->apiEndpoint = '/api/todo-item/' . $this->todoItemToDelete->getAttribute("id");
	}

	/**
	 * Delete endpoint returns 204 HTTP code when authenticated.
	 * 
	 * @return void.
	 */
	public function testDeleteTodoItemReturns204CodeWhenAuthenticated(): void
	{
		// Make a GET request to the index endpoint
		$response = $this->deleteJson($this->apiEndpoint);

		// Assert response is Json
		$response->assertStatus(204);
	}

	/**
	 * Delete endpoint removes information into database.
	 * 
	 * @return void.
	 */
	public function testDeleteTodoItemRemovesInformationFromDatabase(): void
	{
		// Make a DELETE request to the index endpoint
		$this->deleteJson($this->apiEndpoint);

		// Assert the to-do item has been deleted
		$this->assertDatabaseMissing('todo_items', [
			'id' => $this->todoItemToDelete->getAttribute("id"),
		]);
	}
}
<?php

namespace Tests\Feature\TodoItem;

use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TodoItemUpdateTest extends TestCase
{
	use RefreshDatabase;

	private $apiEndpoint;
	private $todoItemToUpdate;
	private $todoItemNewName;
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

		// Create a todo item to update
		$this->todoItemToUpdate = TodoItem::factory()->create([
			'name' => Str::random(10),
			'user_id' => $this->user->getAttribute("id"),
		]);

		$this->apiEndpoint = '/api/todo-item/' . $this->todoItemToUpdate->getAttribute("id");

		// Random name for updating todo item
		$this->todoItemNewName = Str::random(10);
	}

	/**
	 * Update endpoint returns JSON response.
	 * 
	 * @return void.
	 */
	public function testUpdateTodoItemReturnsJsonResponse(): void
	{
		// Make a PATCH request to the index endpoint
		$response = $this->patchJson($this->apiEndpoint, [
			"name" => $this->todoItemNewName,
		]);

		// Assert response is Json
		$this->assertJson($response->getContent());
		$response->assertHeader('Content-Type', 'application/json');
	}

	/**
	 * Update endpoint returns 201 HTTP code.
	 * 
	 * @return void.
	 */
	public function testUpdateTodoItemReturns201Code(): void
	{
		// Make a PATCH request to the index endpoint
		$response = $this->patchJson($this->apiEndpoint, [
			"name" => $this->todoItemNewName,
		]);

		// Assert response has a 201 status code
		$response->assertStatus(201);
	}

	/**
	 * Update endpoint saves information into database.
	 * 
	 * @return void.
	 */
	public function testUpdateTodoItemSavesInformationIntoDatabase(): void
	{
		// Make a PATCH request to the store endpoint
		$this->patchJson($this->apiEndpoint, [
			"name" => $this->todoItemNewName,
		]);

		// Assert the to-do item has been created
		$this->assertDatabaseHas('todo_items', [
			'name' => $this->todoItemNewName,
			'user_id' => $this->user->getAttribute("id"),
		]);
	}
}
<?php

namespace Tests\Unit\Model\TodoItem;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\ToDoItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
  use RefreshDatabase;

  public function testToDoItemBelongsToUser()
  {
    // Create user
    $user = User::factory()->create();

    // Create todo items for user
    $todoItem = ToDoItem::factory()->create([
      'name' => Str::random(5),
      'user_id' => $user->getAttribute('id')
    ]);

    // Retrieve the to-do list associated with the to-do item
    $retrievedTodoItem = $user->todoItems->first();

    // Assert that the relationship exists and is of the correct type
    $this->assertInstanceOf(TodoItem::class, $retrievedTodoItem);

    // Retrieved to-do list should have the same id as the original
    $this->assertEquals(
      $user->getAttribute('id'),
      $retrievedTodoItem->getAttribute('user_id')
    );
  }
}
<?php

namespace Tests\Unit\Model\TodoItem;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\ToDoItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoItemTest extends TestCase
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
    $retrievedUser = $todoItem->getAttribute('user');

    // Assert that the relationship exists and is of the correct type
    $this->assertInstanceOf(User::class, $retrievedUser);

    // Retrieved to-do list should have the same id as the original
    $this->assertEquals(
      $todoItem->getAttribute('user_id'),
      $retrievedUser->getAttribute('id')
    );
  }
}
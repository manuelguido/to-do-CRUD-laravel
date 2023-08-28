<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoItemRequest;
use App\Http\Requests\UpdateTodoItemRequest;
use App\Http\Requests\UpdateTodoItemStatusRequest;
use App\Models\ToDoItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TodoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Auth::user()->todoItems;
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTodoItemRequest $request): JsonResponse
    {
        // Create and store TodoItem
        $todoItem = new TodoItem([
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
        ]);
        $todoItem->save();

        // Success Response
        return response()->json([
            'message' => 'Todo created successfully',
            'success' => true,
            'todo_item' => $todoItem,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTodoItemRequest $request, TodoItem $todoItem): JsonResponse
    {
        // Policy authorization
        $this->authorize('update', $todoItem);

        // Update todo item and save
        $todoItem->update(['name' => $request->input('name')]);
        $todoItem->save();

        // Success Response
        return response()->json([
            'message' => 'Todo updated successfully',
            'success' => true,
            'todo_item' => $todoItem,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(UpdateTodoItemStatusRequest $request, TodoItem $todoItem): JsonResponse
    {
        // Policy authorization
        $this->authorize('update', $todoItem);

        // Update todo item status and save
        $todoItem->update(['is_finished' => $request->input('is_finished')]);
        $todoItem->save();

        // Success Response
        return response()->json([
            'message' => 'Todo updated successfully',
            'success' => true,
            'todo_item' => $todoItem,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TodoItem $todoItem): JsonResponse
    {
        // Policy authorization
        $this->authorize('delete', $todoItem);
        $todoItem->delete();

        // Success Response
        return response()->json([
            'message' => 'Todo deleted successfully',
            'success' => true,
        ], 204);
    }
}
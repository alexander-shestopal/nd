<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TodoController extends Controller
{
    public function store(StoreTodoRequest $request): JsonResponse
    {
        $todo = Todo::create($request->validated());
        return response()->json([
            'message' => 'Todo created successfully',
            'data' => $todo
        ], ResponseAlias::HTTP_CREATED);
    }

    public function index(): JsonResponse
    {
        $todos = Todo::all();
        return response()->json([
            'message' => 'Todos list',
            'data' => $todos
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        return response()->json([
            'message' => 'Todo',
            'data' => $todo
        ]);
    }

    public function update(StoreTodoRequest $request, int $id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $validatedTodo = $request->validated();

        if (empty($validatedTodo['title'])) {
            return response()->json([
                'error' => 'Title cannot be empty.'
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        $todo->update($validatedTodo);
        return response()->json([
            'message' => 'Todo updated successfully',
            'data' => $todo
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json([
            'message' => 'Todo deleted successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Response;
use Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        foreach ($tasks as $item) {
            $row = [
                "id" => $item->id,
                "title" => $item->title,
                "priority" => $item->priority,
                "status" => $item->status,
                "created_at" => $item->created_at,
                "tags" => $item->tags()->get()

            ];
            $rows[] = $row;
        }
        if (isset($rows)) {
            $data = $rows;
        } else $data = [];

        $response = $data;

        return Response::json($response);

    }

    public function show($id)
    {
        $item = Task::find($id);
        $row = [
            "id" => $item->id,
            "title" => $item->title,
            "priority" => $item->priority,
            "status" => $item->status,
            "created_at" => $item->created_at,
            "tags" => $item->tags()->get()
        ];
        if (isset($row)) {
            $data = $row;
        } else $data = [];

        $response = $data;

        return Response::json($response);

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|string|max:255',
            'status' => 'required|boolean',
            'priority' => 'required|integer|min:0|max:2',
        ]);
        $task = Task::create($request->all());
        if ($request->input('tags')):
            $task->tags()->attach($request->input('tags'));
        endif;
        return $task;
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request->validate([
            'title' => 'bail|required|string|max:255',
            'status' => 'required|boolean',
            'priority' => 'required|integer|min:0|max:2',
        ]);
        if ($request->input('tags')):
            $task->tags()->detach();
            $task->tags()->attach($request->input('tags'));
        endif;
        $task->update($request->all());

        return $task;
    }

    public function delete(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->tags()->detach();
        $task->delete();

        return 204;
    }
}

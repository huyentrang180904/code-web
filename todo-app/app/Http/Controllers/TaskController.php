<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:225']);
        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Đã thêm công việc thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);
        $request->validate(['title'=> 'required|string|max:225']);
        $task->update(['title' => $request->title]);

        return redirect()->route('tasks.index')->with('success', 'Đã cập nhật công việc thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', "Xóa công việc thành công");
    }

    public function toggle(Task $task){
        $this->authorizeTask($task);
        $task->update(['is_done'=> !$task->is_done]);
        return redirect()->route('tasks.index');
    }

    public function authorizeTask(Task $task){
        if($task->user_id !== Auth::id()){
            abort(403);
        }
    }
}

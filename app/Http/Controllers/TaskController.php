<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->isAdmin() 
            ? \App\Models\Task::with(['project', 'assignee'])->latest()->paginate(20)
            : auth()->user()->tasks()->with(['project', 'assignee'])->latest()->paginate(20);
            
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $this->authorize('create', \App\Models\Task::class);
        $projects = \App\Models\Project::all();
        $users = \App\Models\User::all();
        return view('tasks.create', compact('projects', 'users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', \App\Models\Task::class);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        // Validation rule: Should not assign tasks to non-project members
        $project = \App\Models\Project::findOrFail($validated['project_id']);
        if (isset($validated['assigned_to']) && !$project->members->contains($validated['assigned_to'])) {
            return back()->withErrors(['assigned_to' => 'Selected user is not a member of this project.'])->withInput();
        }

        \App\Models\Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(\App\Models\Task $task)
    {
        $this->authorize('view', $task);
        $task->load(['project', 'assignee']);
        return view('tasks.show', compact('task'));
    }

    public function edit(\App\Models\Task $task)
    {
        $this->authorize('update', $task);
        $projects = \App\Models\Project::all();
        $users = \App\Models\User::all();
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(Request $request, \App\Models\Task $task)
    {
        $this->authorize('update', $task);

        if (auth()->user()->isAdmin()) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|in:todo,in_progress,completed',
                'priority' => 'required|in:low,medium,high',
                'due_date' => 'nullable|date',
                'assigned_to' => 'nullable|exists:users,id',
                'project_id' => 'required|exists:projects,id',
            ]);

            // Validation rule: Should not assign tasks to non-project members
            $project = \App\Models\Project::findOrFail($validated['project_id']);
            if (isset($validated['assigned_to']) && !$project->members->contains($validated['assigned_to'])) {
                return back()->withErrors(['assigned_to' => 'Selected user is not a member of this project.'])->withInput();
            }

            $task->update($validated);
        } else {
            // Member handles execution only: Pending -> In Progress -> Completed
            $validated = $request->validate([
                'status' => 'required|in:todo,in_progress,completed',
            ]);
            $task->update(['status' => $validated['status']]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(\App\Models\Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->isAdmin() 
            ? \App\Models\Project::with(['owner', 'members'])->latest()->paginate(10)
            : auth()->user()->projects()->with(['owner', 'members'])->latest()->paginate(10);
            
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $this->authorize('create', \App\Models\Project::class);
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', \App\Models\Project::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = auth()->user()->ownedProjects()->create($validated);
        $project->members()->attach(auth()->id());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(\App\Models\Project $project)
    {
        $this->authorize('view', $project);
        $project->load(['tasks.assignee', 'members']);
        return view('projects.show', compact('project'));
    }

    public function edit(\App\Models\Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, \App\Models\Project $project)
    {
        $this->authorize('update', $project);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(\App\Models\Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    public function index()
    {
        return \App\Models\Project::with('owner')->get();
    }

    public function show(\App\Models\Project $project)
    {
        return $project->load(['tasks', 'members']);
    }}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function index()
    {
        return \App\Models\Task::with(['project', 'assignee'])->get();
    }

    public function show(\App\Models\Task $task)
    {
        return $task->load(['project', 'assignee']);
    }}

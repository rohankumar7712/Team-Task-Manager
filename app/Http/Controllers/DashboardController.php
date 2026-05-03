<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $tasksQuery = $user->isAdmin() 
            ? \App\Models\Task::query() 
            : $user->tasks();

        $totalTasks = (clone $tasksQuery)->count();
        $activeTasks = (clone $tasksQuery)->where('status', 'in_progress')->count();
        $completedTasks = (clone $tasksQuery)->where('status', 'completed')->count();
        $overdueTasks = (clone $tasksQuery)->where('status', '!=', 'completed')
                                        ->where('due_date', '<', now())
                                        ->count();

        $recentTasks = (clone $tasksQuery)->with(['project', 'assignee'])
                                          ->latest()
                                          ->take(5)
                                          ->get();

        return view('dashboard', compact('totalTasks', 'activeTasks', 'completedTasks', 'overdueTasks', 'recentTasks'));
    }}

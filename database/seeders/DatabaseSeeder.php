<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@taskflow.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $john = User::factory()->create([
            'name' => 'John Member',
            'email' => 'john@taskflow.com',
            'password' => bcrypt('password'),
            'role' => 'member',
        ]);

        $jane = User::factory()->create([
            'name' => 'Jane Member',
            'email' => 'jane@taskflow.com',
            'password' => bcrypt('password'),
            'role' => 'member',
        ]);

        // Create Projects
        $project1 = \App\Models\Project::create([
            'name' => 'Website Redesign',
            'description' => 'Overhauling the corporate landing page with a modern bento-grid layout.',
            'owner_id' => $admin->id,
        ]);

        $project2 = \App\Models\Project::create([
            'name' => 'Mobile App API',
            'description' => 'Developing the backend REST API for the upcoming mobile application.',
            'owner_id' => $admin->id,
        ]);

        // Add members to projects
        $project1->members()->attach([$john->id, $jane->id]);
        $project2->members()->attach([$john->id]);

        // Create Tasks for Project 1
        \App\Models\Task::create([
            'title' => 'Design Hero Section',
            'description' => 'Create a high-fidelity mockup for the landing page hero section.',
            'status' => 'completed',
            'priority' => 'high',
            'due_date' => now()->subDays(2),
            'assigned_to' => $john->id,
            'project_id' => $project1->id,
        ]);

        \App\Models\Task::create([
            'title' => 'Implement Auth Flow',
            'description' => 'Set up login and registration pages using Laravel Breeze.',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addDays(3),
            'assigned_to' => $jane->id,
            'project_id' => $project1->id,
        ]);

        \App\Models\Task::create([
            'title' => 'Footer Components',
            'description' => 'Develop reusable Blade components for the footer.',
            'status' => 'todo',
            'priority' => 'low',
            'due_date' => now()->addDays(7),
            'assigned_to' => $john->id,
            'project_id' => $project1->id,
        ]);

        // Create Tasks for Project 2
        \App\Models\Task::create([
            'title' => 'Database Schema Design',
            'description' => 'Plan the migration structure for user profiles and roles.',
            'status' => 'completed',
            'priority' => 'high',
            'due_date' => now()->subDays(5),
            'assigned_to' => $admin->id,
            'project_id' => $project2->id,
        ]);

        \App\Models\Task::create([
            'title' => 'Sanctum Integration',
            'description' => 'Configure Sanctum for token-based authentication.',
            'status' => 'in_progress',
            'priority' => 'medium',
            'due_date' => now()->addDays(2),
            'assigned_to' => $john->id,
            'project_id' => $project2->id,
        ]);
    }
}

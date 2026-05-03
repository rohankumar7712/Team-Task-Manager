<x-app-layout>
    <div class="max-w-3xl mx-auto space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('tasks.show', $task) }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-h1 text-h2 text-on-surface">Modify Task Status</h1>
                <p class="font-body-sm text-on-surface-variant">Update the details and progression for <span class="font-bold text-primary">{{ $task->title }}</span>.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-8">
                <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Selection -->
                        <div class="space-y-2">
                            <label for="project_id" class="font-label-md text-on-surface">Project Scope</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">folder_shared</span>
                                <select name="project_id" id="project_id" required @disabled(!Auth::user()->isAdmin())
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Assignee Selection -->
                        <div class="space-y-2">
                            <label for="assigned_to" class="font-label-md text-on-surface">Assigned To</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">person_search</span>
                                <select name="assigned_to" id="assigned_to" @disabled(!Auth::user()->isAdmin())
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                                    <option value="">Unassigned</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>
                    </div>

                    <!-- Task Title -->
                    <div class="space-y-2">
                        <label for="title" class="font-label-md text-on-surface">Task Title</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">edit_note</span>
                            <input type="text" name="title" id="title" value="{{ $task->title }}" required @disabled(!Auth::user()->isAdmin())
                                class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all disabled:opacity-60 disabled:cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="font-label-md text-on-surface">Detailed Description</label>
                        <textarea name="description" id="description" rows="4" @disabled(!Auth::user()->isAdmin())
                            class="w-full p-4 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all resize-none disabled:opacity-60 disabled:cursor-not-allowed">{{ $task->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Priority -->
                        <div class="space-y-2">
                            <label for="priority" class="font-label-md text-on-surface">Priority Level</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">priority_high</span>
                                <select name="priority" id="priority" @disabled(!Auth::user()->isAdmin())
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low Priority</option>
                                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium Priority</option>
                                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High Priority</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label for="status" class="font-label-md text-on-surface">Current Status</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">radio_button_checked</span>
                                <select name="status" id="status" 
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer">
                                    <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>To Do</option>
                                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Due Date -->
                        <div class="space-y-2">
                            <label for="due_date" class="font-label-md text-on-surface">Target Deadline</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">calendar_month</span>
                                <input type="date" name="due_date" id="due_date" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}" @disabled(!Auth::user()->isAdmin())
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all disabled:opacity-60 disabled:cursor-not-allowed">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 flex items-center gap-4">
                        <button type="submit" class="flex-1 bg-primary text-white py-4 rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-primary-container transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">save</span>
                            Save Updates
                        </button>
                        <a href="{{ route('tasks.show', $task) }}" class="px-10 py-4 border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                            Discard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

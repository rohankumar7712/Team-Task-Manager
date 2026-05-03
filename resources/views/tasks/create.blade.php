<x-app-layout>
    <div class="max-w-3xl mx-auto space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('tasks.index') }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-h1 text-h2 text-on-surface">Create New Task</h1>
                <p class="font-body-sm text-on-surface-variant">Break down your project into manageable units of work.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-8">
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Selection -->
                        <div class="space-y-2">
                            <label for="project_id" class="font-label-md text-on-surface">Project Scope</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">folder_shared</span>
                                <select name="project_id" id="project_id" required 
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
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
                                <select name="assigned_to" id="assigned_to" 
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer">
                                    <option value="">Unassigned</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">assignment</span>
                            <input type="text" name="title" id="title" required 
                                class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all"
                                placeholder="e.g. Implement user authentication flow">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="font-label-md text-on-surface">Detailed Description</label>
                        <textarea name="description" id="description" rows="4" 
                            class="w-full p-4 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all resize-none"
                            placeholder="Provide technical details, requirements, or acceptance criteria..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Priority -->
                        <div class="space-y-2">
                            <label for="priority" class="font-label-md text-on-surface">Priority Level</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">priority_high</span>
                                <select name="priority" id="priority" 
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer">
                                    <option value="low">Low Priority</option>
                                    <option value="medium" selected>Medium Priority</option>
                                    <option value="high">High Priority</option>
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
                                    <option value="todo">To Do</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Due Date -->
                        <div class="space-y-2">
                            <label for="due_date" class="font-label-md text-on-surface">Target Deadline</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">calendar_month</span>
                                <input type="date" name="due_date" id="due_date" 
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 flex items-center gap-4">
                        <button type="submit" class="flex-1 bg-primary text-white py-4 rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-primary-container transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">add_circle</span>
                            Dispatch Task
                        </button>
                        <a href="{{ route('tasks.index') }}" class="px-10 py-4 border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

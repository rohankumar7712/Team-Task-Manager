<x-app-layout>
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="font-h1 text-h1 text-on-surface">Tasks</h1>
                <p class="font-body-md text-on-surface-variant">Manage and monitor team performance across all active projects.</p>
            </div>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('tasks.create') }}" class="bg-primary text-white px-6 py-2.5 rounded-lg font-label-md flex items-center gap-2 shadow-sm hover:opacity-90 transition-all active:scale-95">
                <span class="material-symbols-outlined text-xl">add_task</span>
                Create Task
            </a>
            @endif
        </div>

        <!-- Filters Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2 bg-white p-4 rounded-xl border border-outline-variant shadow-sm flex flex-col gap-2">
                <label class="font-label-sm text-outline uppercase tracking-wider text-[10px]">Search Tasks</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">search</span>
                    <input class="w-full pl-10 pr-4 py-2 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 font-body-sm outline-none transition-all" placeholder="Filter by title or keyword..." type="text"/>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-outline-variant shadow-sm flex flex-col gap-2">
                <label class="font-label-sm text-outline uppercase tracking-wider text-[10px]">Project</label>
                <select class="w-full bg-transparent border-none font-body-sm text-on-surface outline-none cursor-pointer">
                    <option>All Projects</option>
                    <!-- Dynamically populated options could go here -->
                </select>
            </div>
            <div class="bg-white p-4 rounded-xl border border-outline-variant shadow-sm flex flex-col gap-2">
                <label class="font-label-sm text-outline uppercase tracking-wider text-[10px]">Status</label>
                <select class="w-full bg-transparent border-none font-body-sm text-on-surface outline-none cursor-pointer">
                    <option>All Statuses</option>
                    <option>Pending</option>
                    <option>In Progress</option>
                    <option>Completed</option>
                </select>
            </div>
        </div>

        <!-- Tasks Table -->
        <div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low border-b border-outline-variant">
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Title</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Project</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Assigned To</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Status</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Due Date</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($tasks as $task)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-1 h-6 {{ $task->priority === 'high' ? 'bg-rose-500' : ($task->priority === 'medium' ? 'bg-amber-400' : 'bg-emerald-500') }} rounded-full"></div>
                                    <span class="font-label-md text-on-surface">{{ $task->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-body-sm text-on-surface-variant">{{ $task->project->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-bold text-indigo-700 border border-indigo-200">
                                        {{ $task->assignee ? substr($task->assignee->name, 0, 1) : '?' }}
                                    </div>
                                    <span class="font-body-sm text-on-surface">{{ $task->assignee->name ?? 'Unassigned' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : ($task->status === 'overdue' ? 'bg-rose-100 text-rose-700' : 'bg-indigo-100 text-indigo-700') }} text-[10px] font-bold uppercase tracking-tight inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 {{ $task->status === 'completed' ? 'bg-emerald-500' : ($task->status === 'overdue' ? 'bg-rose-500' : 'bg-indigo-500') }} rounded-full"></span>
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-body-sm text-on-surface-variant">
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-1">
                                <a href="{{ route('tasks.show', $task) }}" class="p-2 text-outline hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </a>
                                @if(Auth::user()->isAdmin() || Auth::id() === ($task->project->owner_id ?? null))
                                <a href="{{ route('tasks.edit', $task) }}" class="p-2 text-outline hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-outline italic">No tasks found in this workspace.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($tasks->hasPages())
            <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant">
                {{ $tasks->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

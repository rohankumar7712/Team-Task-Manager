<x-app-layout>
    <div class="space-y-8">
        <!-- Breadcrumbs & Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('projects.index') }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h1 class="font-h1 text-h1 text-on-surface">{{ $project->name }}</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Enterprise</span>
                        <span class="text-outline text-sm font-medium">Owned by {{ $project->owner->name }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if(Auth::user()->isAdmin() || Auth::id() === $project->owner_id)
                <a href="{{ route('projects.edit', $project) }}" class="flex items-center gap-2 px-5 py-2.5 border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                    <span class="material-symbols-outlined text-xl">settings</span>
                    Settings
                </a>
                @endif
                <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-primary-container transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-xl">add_task</span>
                    New Task
                </a>
            </div>
        </div>

        <!-- Description Card -->
        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm p-8">
            <h3 class="font-label-sm text-outline uppercase tracking-widest mb-4">Project Overview</h3>
            <p class="font-body-lg text-on-surface leading-relaxed max-w-4xl">
                {{ $project->description ?: 'No detailed description available for this project.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Tasks Column -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-h3 text-on-surface">Active Tasks</h3>
                    <div class="flex items-center gap-2 text-sm text-outline">
                        <span class="material-symbols-outlined text-lg text-emerald-500">check_circle</span>
                        {{ $project->tasks->where('status', 'completed')->count() }}/{{ $project->tasks->count() }} Completed
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant">
                                <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Title</th>
                                <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Assignee</th>
                                <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Status</th>
                                <th class="px-6 py-4 text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @forelse($project->tasks as $task)
                            <tr class="hover:bg-surface-container-lowest transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-1 h-5 {{ $task->priority === 'high' ? 'bg-rose-500' : 'bg-emerald-500' }} rounded-full"></div>
                                        <a href="{{ route('tasks.show', $task) }}" class="font-label-md text-on-surface group-hover:text-primary transition-colors">{{ $task->title }}</a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-body-sm text-on-surface-variant">{{ $task->assignee->name ?? 'Unassigned' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} text-[10px] font-bold uppercase tracking-tighter">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('tasks.show', $task) }}" class="p-2 text-outline hover:text-primary transition-all">
                                        <span class="material-symbols-outlined text-xl">open_in_new</span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-outline italic">No tasks assigned to this project yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Team Sidebar -->
            <div class="space-y-6">
                <h3 class="font-h3 text-on-surface">Team Access</h3>
                <div class="bg-white rounded-2xl border border-outline-variant shadow-sm p-6 space-y-6">
                    @foreach($project->members as $member)
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-primary font-bold shadow-inner">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-on-surface">{{ $member->name }}</p>
                                <p class="text-[10px] text-outline uppercase tracking-wider font-semibold">{{ $member->role }}</p>
                            </div>
                        </div>
                        @if($member->id === $project->owner_id)
                        <span class="material-symbols-outlined text-amber-400" title="Project Owner">verified</span>
                        @endif
                    </div>
                    @endforeach

                    <button class="w-full mt-4 py-3 border-2 border-dashed border-outline-variant rounded-xl text-outline font-label-md hover:border-primary hover:text-primary hover:bg-indigo-50/50 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">person_add</span>
                        Manage Access
                    </button>
                </div>

                <!-- Project Health -->
                <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-100">
                    <h4 class="font-label-sm text-emerald-700 uppercase tracking-widest mb-4">Project Health</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-end">
                            <span class="text-sm text-emerald-600 font-medium">Timeline Progress</span>
                            <span class="text-lg font-bold text-emerald-700">{{ $project->tasks->count() > 0 ? round(($project->tasks->where('status', 'completed')->count() / $project->tasks->count()) * 100) : 0 }}%</span>
                        </div>
                        <div class="w-full bg-emerald-200/50 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full transition-all duration-500" style="width: {{ $project->tasks->count() > 0 ? ($project->tasks->where('status', 'completed')->count() / $project->tasks->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

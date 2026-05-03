<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('tasks.index') }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h1 class="font-h1 text-h2 text-on-surface">Task Specification</h1>
                    <p class="font-body-sm text-on-surface-variant">Detailed breakdown of work unit <span class="font-bold text-primary">#{{ $task->id }}</span>.</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('tasks.edit', $task) }}" class="flex items-center gap-2 px-5 py-2.5 border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                    <span class="material-symbols-outlined text-xl">edit</span>
                    @if(Auth::user()->isAdmin()) Edit Task @else Update Status @endif
                </a>
                @if(Auth::user()->isAdmin())
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-2 px-5 py-2.5 bg-rose-50 text-rose-600 rounded-xl font-bold hover:bg-rose-100 transition-all active:scale-[0.98]">
                        <span class="material-symbols-outlined text-xl">delete</span>
                        Delete
                    </button>
                </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl border border-outline-variant shadow-sm p-8 space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} text-[10px] font-bold uppercase tracking-widest">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                        <span class="w-1.5 h-1.5 bg-outline-variant rounded-full"></span>
                        <span class="text-sm font-medium text-outline">{{ $task->project->name }}</span>
                    </div>
                    
                    <h2 class="text-3xl font-black text-on-surface leading-tight">{{ $task->title }}</h2>
                    
                    <div class="prose prose-slate max-w-none">
                        <p class="font-body-lg text-on-surface-variant leading-relaxed">
                            {{ $task->description ?: 'No detailed documentation provided for this task.' }}
                        </p>
                    </div>
                </div>

                <!-- Discussion/Comments Placeholder -->
                <div class="bg-surface-container-low rounded-2xl border border-outline-variant p-8 border-dashed flex flex-col items-center justify-center text-center space-y-3">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-outline shadow-sm">
                        <span class="material-symbols-outlined">forum</span>
                    </div>
                    <div>
                        <p class="font-label-md text-on-surface">Communication Channel</p>
                        <p class="text-xs text-outline">Collaborative comments are currently disabled for this workspace.</p>
                    </div>
                </div>
            </div>

            <!-- Meta Sidebar -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-outline-variant bg-surface-container-low">
                        <h3 class="font-label-sm text-outline uppercase tracking-widest">Execution Details</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Priority -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-on-surface-variant font-medium">Priority</span>
                            <span class="flex items-center gap-1.5 font-bold {{ $task->priority === 'high' ? 'text-rose-600' : 'text-emerald-600' }}">
                                <span class="material-symbols-outlined text-lg">{{ $task->priority === 'high' ? 'signal_cellular_alt' : 'signal_cellular_alt_1_bar' }}</span>
                                {{ ucfirst($task->priority) }}
                            </span>
                        </div>

                        <!-- Due Date -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-on-surface-variant font-medium">Deadline</span>
                            <span class="font-bold text-on-surface flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-lg text-outline">calendar_today</span>
                                {{ $task->due_date ? $task->due_date->format('M d, Y') : 'Open' }}
                            </span>
                        </div>

                        <!-- Assigned To -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-on-surface-variant font-medium">Assignee</span>
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-primary-container text-white flex items-center justify-center text-[10px] font-bold shadow-sm">
                                    {{ $task->assignee ? substr($task->assignee->name, 0, 1) : '?' }}
                                </div>
                                <span class="font-bold text-on-surface text-sm">{{ $task->assignee->name ?? 'Unassigned' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Quick Link -->
                <a href="{{ route('projects.show', $task->project) }}" class="block bg-indigo-600 rounded-2xl p-6 text-white hover:bg-indigo-700 transition-all group relative overflow-hidden">
                    <div class="relative z-10">
                        <p class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest mb-1">Assigned Project</p>
                        <h4 class="text-lg font-bold group-hover:underline underline-offset-4">{{ $task->project->name }}</h4>
                    </div>
                    <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:rotate-12 transition-transform">folder_shared</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

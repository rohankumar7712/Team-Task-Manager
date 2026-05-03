<x-app-layout>
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="font-h1 text-h1 text-on-surface">Overview</h1>
                <p class="font-body-md text-on-surface-variant">Manage your workspace performance and track team progress.</p>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-4 py-2 border border-outline-variant rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-low transition-all">
                    <span class="material-symbols-outlined text-base">calendar_today</span>
                    Last 30 Days
                </button>
                <button class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg font-label-md shadow-sm hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined text-base">download</span>
                    Export Report
                </button>
            </div>
        </div>

        <!-- Bento Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Tasks -->
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-indigo-50 rounded-lg text-primary">
                        <span class="material-symbols-outlined">task</span>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">+12%</span>
                </div>
                <p class="text-outline font-label-sm uppercase tracking-wider">Total Tasks</p>
                <h3 class="text-3xl font-bold text-on-surface mt-1">{{ $totalTasks }}</h3>
                <div class="mt-4 flex items-center text-xs text-outline gap-1">
                    <span class="material-symbols-outlined text-sm">history</span>
                    Updated 2 mins ago
                </div>
            </div>

            <!-- Active Tasks -->
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                        <span class="material-symbols-outlined">pending_actions</span>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">Active</span>
                </div>
                <p class="text-outline font-label-sm uppercase tracking-wider">Active Tasks</p>
                <h3 class="text-3xl font-bold text-on-surface mt-1">{{ $activeTasks }}</h3>
                <div class="mt-4 w-full bg-surface-container-low h-1.5 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full w-[65%]"></div>
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-indigo-400"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <span class="text-xs font-bold text-outline bg-surface-container-low px-2 py-1 rounded">{{ $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0 }}% rate</span>
                </div>
                <p class="text-outline font-label-sm uppercase tracking-wider">Completed</p>
                <h3 class="text-3xl font-bold text-on-surface mt-1">{{ $completedTasks }}</h3>
                <div class="mt-4 flex items-center text-xs text-outline gap-1">
                    <span class="material-symbols-outlined text-sm">trending_up</span>
                    Trending higher
                </div>
            </div>

            <!-- Overdue -->
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-rose-500"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-rose-50 rounded-lg text-rose-600">
                        <span class="material-symbols-outlined">error</span>
                    </div>
                    <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded">Priority</span>
                </div>
                <p class="text-outline font-label-sm uppercase tracking-wider">Overdue</p>
                <h3 class="text-3xl font-bold text-on-surface mt-1">{{ $overdueTasks }}</h3>
                <div class="mt-4 flex items-center text-xs text-rose-600 gap-1">
                    <span class="material-symbols-outlined text-sm">warning</span>
                    Needs attention
                </div>
            </div>
        </div>

        <!-- Recent Tasks Table -->
        <div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-6 border-b border-outline-variant flex justify-between items-center bg-surface-container-low">
                <h3 class="font-h3 text-on-surface">Recent Tasks</h3>
                <a href="{{ route('tasks.index') }}" class="text-primary font-label-md hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-surface-container-lowest border-b border-outline-variant">
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-wider">Task Title</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-wider">Project</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-wider">Due Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($recentTasks as $task)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-6 py-4 font-label-md text-on-surface">{{ $task->title }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-md bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                    {{ $task->project->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ $task->status === 'completed' ? 'bg-emerald-500' : 'bg-amber-400' }}"></span>
                                    <span class="text-sm font-medium text-on-surface-variant">{{ ucfirst($task->status) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">
                                {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No date' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-outline">No recent tasks found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

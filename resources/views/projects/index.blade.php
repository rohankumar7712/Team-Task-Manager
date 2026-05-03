<x-app-layout>
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-h1 text-h1 text-on-surface">Projects</h1>
                <p class="font-body-md text-on-surface-variant">Manage and track your ongoing team initiatives.</p>
            </div>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary text-white rounded-lg font-label-md shadow-sm active:scale-95 transition-all">
                <span class="material-symbols-outlined text-xl">add</span>
                New Project
            </a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col">
                <div class="h-1.5 {{ $loop->index % 3 == 0 ? 'bg-primary' : ($loop->index % 3 == 1 ? 'bg-emerald-500' : 'bg-amber-400') }}"></div>
                <div class="p-6 flex-1">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-h3 text-xl text-on-surface group-hover:text-primary transition-colors">{{ $project->name }}</h3>
                        <span class="bg-surface-container-low text-outline px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Active</span>
                    </div>
                    <p class="font-body-sm text-on-surface-variant mb-6 line-clamp-3">
                        {{ $project->description ?: 'No description provided for this project.' }}
                    </p>
                    <div class="flex items-center -space-x-2">
                        @foreach($project->members->take(3) as $user)
                        <div class="h-8 w-8 rounded-full border-2 border-white bg-primary-container text-white flex items-center justify-center text-[10px] font-bold shadow-sm" title="{{ $user->name }}">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        @endforeach
                        @if($project->members->count() > 3)
                        <div class="h-8 w-8 rounded-full border-2 border-white bg-surface-container-high text-outline flex items-center justify-center text-[10px] font-bold shadow-sm">
                            +{{ $project->members->count() - 3 }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="px-6 py-4 bg-surface-container-lowest border-t border-outline-variant flex items-center justify-between">
                    <div class="flex gap-2">
                        <a href="{{ route('projects.show', $project) }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-lg transition-all" title="View Details">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        @if(Auth::user()->isAdmin() || Auth::id() === $project->owner_id)
                        <a href="{{ route('projects.edit', $project) }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-lg transition-all" title="Edit Project">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        @endif
                    </div>
                    @if(Auth::user()->isAdmin() || Auth::id() === $project->owner_id)
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-outline hover:text-error hover:bg-rose-50 rounded-lg transition-all" title="Delete Project">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach

            @if(Auth::user()->isAdmin())
            <!-- Add Project Placeholder -->
            <a href="{{ route('projects.create') }}" class="border-2 border-dashed border-outline-variant rounded-xl p-6 flex flex-col items-center justify-center text-outline hover:border-primary hover:text-primary hover:bg-indigo-50/30 transition-all active:scale-95 group">
                <span class="material-symbols-outlined text-4xl mb-2 group-hover:scale-110 transition-transform">add_circle</span>
                <span class="font-label-md">Create New Project</span>
            </a>
            @endif
        </div>

        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>

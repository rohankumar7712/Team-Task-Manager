<x-app-layout>
    <div class="max-w-2xl mx-auto space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('projects.index') }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-h1 text-h2 text-on-surface">Create New Project</h1>
                <p class="font-body-sm text-on-surface-variant">Define the scope and objectives of your new initiative.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-8">
                <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Project Name -->
                    <div class="space-y-2">
                        <label for="name" class="font-label-md text-on-surface">Project Name</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">folder</span>
                            <input type="text" name="name" id="name" required 
                                class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all"
                                placeholder="e.g. Website Redesign 2024">
                        </div>
                        @error('name') 
                            <p class="text-xs text-error mt-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">error</span>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="font-label-md text-on-surface">Description</label>
                        <div class="relative">
                            <textarea name="description" id="description" rows="5" 
                                class="w-full p-4 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all resize-none"
                                placeholder="Describe the project goals, milestones, and expected outcomes..."></textarea>
                        </div>
                        @error('description') 
                            <p class="text-xs text-error mt-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">error</span>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-4 flex items-center gap-4">
                        <button type="submit" class="flex-1 bg-primary text-white py-3.5 rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-primary-container transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">rocket_launch</span>
                            Initialize Project
                        </button>
                        <a href="{{ route('projects.index') }}" class="px-8 py-3.5 border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Pro Tip Card -->
        <div class="bg-indigo-50/50 rounded-xl p-6 border border-indigo-100 flex items-start gap-4">
            <div class="p-2 bg-white rounded-lg text-primary shadow-sm">
                <span class="material-symbols-outlined">lightbulb</span>
            </div>
            <div>
                <h4 class="font-label-md text-primary mb-1">Pro Tip</h4>
                <p class="text-sm text-on-surface-variant leading-relaxed">
                    A clear project description helps team members understand the context and reduces alignment issues during the execution phase.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

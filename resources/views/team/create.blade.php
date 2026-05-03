<x-app-layout>
    <div class="max-w-2xl mx-auto space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('team.index') }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-h1 text-h2 text-on-surface">Onboard New Member</h1>
                <p class="font-body-sm text-on-surface-variant">System will automatically generate TaskFlow credentials.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-8">
                <form action="{{ route('team.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Member Name -->
                    <div class="space-y-2">
                        <label for="name" class="font-label-md text-on-surface">Legal Full Name</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">person</span>
                            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all"
                                placeholder="e.g. Johnathan Doe">
                        </div>
                        <p class="text-[10px] text-outline italic">Used to generate company email (e.g. johnathan-doe@taskflow.com)</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date of Birth -->
                        <div class="space-y-2">
                            <label for="dob" class="font-label-md text-on-surface">Date of Birth</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">cake</span>
                                <input type="date" name="dob" id="dob" required value="{{ old('dob') }}"
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="space-y-2">
                            <label for="role" class="font-label-md text-on-surface">Workspace Role</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">badge</span>
                                <select name="role" id="role" required 
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer">
                                    <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Email Address -->
                    <div class="space-y-2">
                        <label for="personal_email" class="font-label-md text-on-surface">Personal Email ID</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input type="email" name="personal_email" id="personal_email" required value="{{ old('personal_email') }}"
                                class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all"
                                placeholder="personal.email@gmail.com">
                        </div>
                        @error('personal_email') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-indigo-50 rounded-xl p-4 border border-indigo-100 flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">security</span>
                        <p class="text-xs text-on-surface-variant leading-relaxed">
                            <strong>Note:</strong> Password will be randomly generated. Admin will have visibility of the credentials in the member directory.
                        </p>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-4 flex items-center gap-4">
                        <button type="submit" class="flex-1 bg-primary text-white py-3.5 rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-primary-container transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">person_add</span>
                            Finalize Onboarding
                        </button>
                        <a href="{{ route('team.index') }}" class="px-8 py-3.5 border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

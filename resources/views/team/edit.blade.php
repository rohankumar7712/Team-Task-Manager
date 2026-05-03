<x-app-layout>
    <div class="max-w-2xl mx-auto space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('team.show', $member) }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-h1 text-h2 text-on-surface">Edit Member Profile</h1>
                <p class="font-body-sm text-on-surface-variant">Update identity, credentials, or access levels for <span class="font-bold text-primary">{{ $member->name }}</span>.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-8">
                <form action="{{ route('team.update', $member->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Member Name -->
                        <div class="space-y-2">
                            <label for="name" class="font-label-md text-on-surface">Full Name</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">person</span>
                                <input type="text" name="name" id="name" required value="{{ old('name', $member->name) }}"
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="space-y-2">
                            <label for="dob" class="font-label-md text-on-surface">Date of Birth</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">cake</span>
                                <input type="date" name="dob" id="dob" required value="{{ old('dob', $member->dob) }}"
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Company Email -->
                        <div class="space-y-2">
                            <label for="email" class="font-label-md text-on-surface">Company Email (Login)</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">corporate_fare</span>
                                <input type="email" name="email" id="email" required value="{{ old('email', $member->email) }}"
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                            </div>
                            @error('email') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Personal Email -->
                        <div class="space-y-2">
                            <label for="personal_email" class="font-label-md text-on-surface">Personal Email</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">mail</span>
                                <input type="email" name="personal_email" id="personal_email" required value="{{ old('personal_email', $member->personal_email) }}"
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                            </div>
                            @error('personal_email') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Role Selection -->
                        <div class="space-y-2">
                            <label for="role" class="font-label-md text-on-surface">System Role</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">badge</span>
                                <select name="role" id="role" required 
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all appearance-none cursor-pointer">
                                    <option value="member" {{ old('role', $member->role) == 'member' ? 'selected' : '' }}>Member</option>
                                    <option value="admin" {{ old('role', $member->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Plain Password -->
                        <div class="space-y-2">
                            <label for="plain_password" class="font-label-md text-on-surface">Current Password</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">lock</span>
                                <input type="text" name="plain_password" id="plain_password" required value="{{ old('plain_password', $member->plain_password) }}"
                                    class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-xl font-body-md focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                            </div>
                            <p class="text-[10px] text-outline italic">Changing this will automatically update the user's login hash.</p>
                        </div>
                    </div>

                    <div class="pt-6 flex items-center gap-4">
                        <button type="submit" class="flex-1 bg-primary text-white py-4 rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-primary-container transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">save</span>
                            Commit Changes
                        </button>
                        <a href="{{ route('team.show', $member) }}" class="px-10 py-4 border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

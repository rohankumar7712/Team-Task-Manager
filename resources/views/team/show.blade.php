<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('team.index') }}" class="p-2 text-outline hover:text-primary hover:bg-surface-container-low rounded-full transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="font-h1 text-h2 text-on-surface">Member Profile</h1>
                <p class="font-body-sm text-on-surface-variant">Administrative view of member credentials and personal data.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Primary Identity -->
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl border border-outline-variant shadow-sm p-8 flex flex-col items-center text-center space-y-4">
                    <div class="w-24 h-24 rounded-full bg-indigo-600 text-white flex items-center justify-center text-3xl font-black shadow-lg shadow-indigo-100">
                        {{ substr($member->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-on-surface">{{ $member->name }}</h2>
                        <span class="px-3 py-1 rounded-full {{ $member->isAdmin() ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-700' }} text-[10px] font-bold uppercase tracking-widest mt-2 inline-block">
                            {{ $member->role }}
                        </span>
                    </div>
                </div>

                <div class="bg-surface-container-low rounded-2xl border border-outline-variant p-6 space-y-4">
                    <h3 class="font-label-sm text-outline uppercase tracking-widest text-[10px]">Quick Actions</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('team.edit', $member) }}" class="flex items-center gap-3 px-4 py-3 bg-white border border-outline-variant rounded-xl text-sm font-bold text-on-surface hover:bg-indigo-50 hover:text-primary transition-all shadow-sm">
                            <span class="material-symbols-outlined text-lg">edit</span>
                            Update Details
                        </a>
                        @if($member->id !== Auth::id())
                        <form action="{{ route('team.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 bg-white border border-outline-variant rounded-xl text-sm font-bold text-error hover:bg-rose-50 transition-all shadow-sm">
                                <span class="material-symbols-outlined text-lg">person_remove</span>
                                Terminate Access
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Detailed Data -->
            <div class="md:col-span-2 space-y-6">
                <!-- Credentials Section -->
                <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-outline-variant bg-surface-container-low flex items-center justify-between">
                        <h3 class="font-label-sm text-outline uppercase tracking-widest text-[10px]">Security Credentials</h3>
                        <span class="material-symbols-outlined text-outline">key</span>
                    </div>
                    <div class="p-8 space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1">
                                <p class="text-[10px] text-outline uppercase tracking-widest font-bold">Company Email</p>
                                <div class="flex items-center gap-2 group">
                                    <p class="font-mono text-sm text-on-surface font-bold">{{ $member->email }}</p>
                                    <button onclick="copyToClipboard('{{ $member->email }}', 'Email')" class="text-outline hover:text-primary opacity-0 group-hover:opacity-100 transition-all">
                                        <span class="material-symbols-outlined text-base">content_copy</span>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] text-outline uppercase tracking-widest font-bold">Live Password</p>
                                <div class="flex items-center gap-2 group">
                                    <p class="font-mono text-sm text-primary font-bold bg-indigo-50 px-2 py-1 rounded">{{ $member->plain_password }}</p>
                                    <button onclick="copyToClipboard('{{ $member->plain_password }}', 'Password')" class="text-outline hover:text-primary opacity-0 group-hover:opacity-100 transition-all">
                                        <span class="material-symbols-outlined text-base">content_copy</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Info Section -->
                <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-outline-variant bg-surface-container-low flex items-center justify-between">
                        <h3 class="font-label-sm text-outline uppercase tracking-widest text-[10px]">Personal Documentation</h3>
                        <span class="material-symbols-outlined text-outline">contact_page</span>
                    </div>
                    <div class="p-8 space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1">
                                <p class="text-[10px] text-outline uppercase tracking-widest font-bold">Personal Email</p>
                                <p class="font-body-md text-on-surface">{{ $member->personal_email ?? 'N/A' }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] text-outline uppercase tracking-widest font-bold">Date of Birth</p>
                                <p class="font-body-md text-on-surface">
                                    {{ $member->dob ? \Carbon\Carbon::parse($member->dob)->format('M d, Y') : 'N/A' }}
                                    <span class="text-[10px] text-outline ml-2">
                                        ({{ $member->dob ? \Carbon\Carbon::parse($member->dob)->age : '?' }} years old)
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-outline-variant">
                            <p class="text-[10px] text-outline uppercase tracking-widest font-bold mb-2">Member Since</p>
                            <p class="text-sm text-on-surface-variant italic">{{ $member->created_at->format('l, F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text, type) {
            navigator.clipboard.writeText(text);
            alert(type + ' copied to clipboard!');
        }
    </script>
</x-app-layout>

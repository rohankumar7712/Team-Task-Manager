<x-app-layout>
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="font-h1 text-h1 text-on-surface">Team Management</h1>
                <p class="font-body-md text-on-surface-variant">Manage workspace members and their roles.</p>
            </div>
            <a href="{{ route('team.create') }}" class="bg-primary text-white px-6 py-2.5 rounded-lg font-label-md flex items-center gap-2 shadow-sm hover:opacity-90 transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined text-xl">person_add</span>
                Add Member
            </a>
        </div>

        @if(session('generated_password'))
        <div class="bg-indigo-50 border border-indigo-200 rounded-2xl p-6 space-y-4 mb-8">
            <div class="flex items-center gap-3 text-primary">
                <span class="material-symbols-outlined font-bold">badge</span>
                <p class="font-bold">New Member Credentials Generated</p>
            </div>
            
            <div class="bg-white rounded-xl border border-indigo-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-4 flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-[10px] text-outline uppercase tracking-widest font-bold mb-1">Company Email</p>
                            <div class="flex items-center gap-2">
                                <code class="text-sm font-mono text-on-surface bg-surface-container-low px-2 py-1 rounded">{{ session('generated_email') }}</code>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] text-outline uppercase tracking-widest font-bold mb-1">Temporary Password</p>
                            <div class="flex items-center gap-2">
                                <code id="generated-password" class="text-sm font-mono text-on-surface bg-surface-container-low px-2 py-1 rounded">{{ session('generated_password') }}</code>
                                <button onclick="copyPassword()" class="text-primary hover:bg-indigo-50 p-1 rounded transition-colors" title="Copy to clipboard">
                                    <span class="material-symbols-outlined text-base">content_copy</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-amber-50 text-amber-800 text-[10px] p-3 rounded-lg border border-amber-100 max-w-xs">
                    <p class="font-bold flex items-center gap-1 mb-1">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        IMPORTANT
                    </p>
                    Share these credentials immediately. They will disappear if you refresh or navigate away.
                </div>
            </div>
        </div>

        <script>
            function copyPassword() {
                const password = document.getElementById('generated-password').innerText;
                navigator.clipboard.writeText(password);
                alert('Password copied to clipboard!');
            }
        </script>
        @endif

        <div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low border-b border-outline-variant">
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Name</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Email</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Role</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px]">Joined At</th>
                            <th class="px-6 py-4 font-label-sm text-outline uppercase tracking-widest text-[10px] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($members as $member)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-container text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                    <span class="font-label-md text-on-surface">{{ $member->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-body-sm text-on-surface-variant">{{ $member->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full {{ $member->isAdmin() ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-700' }} text-[10px] font-bold uppercase tracking-tight">
                                    {{ $member->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-body-sm text-on-surface-variant">{{ $member->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('team.show', $member) }}" class="p-2 text-outline hover:text-primary hover:bg-indigo-50 rounded-lg transition-all" title="View Details">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                    </a>
                                    <a href="{{ route('team.edit', $member) }}" class="p-2 text-outline hover:text-primary hover:bg-indigo-50 rounded-lg transition-all" title="Edit Member">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    @if($member->id !== Auth::id())
                                    <form action="{{ route('team.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-outline hover:text-error hover:bg-rose-50 rounded-lg transition-all" title="Delete Member">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

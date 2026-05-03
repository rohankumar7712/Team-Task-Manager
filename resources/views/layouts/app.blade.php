<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
        </style>
    </head>
    <body class="bg-background font-body-md text-on-background min-h-screen">
        <!-- Sidebar -->
        <aside class="h-screen w-64 fixed left-0 top-0 border-r border-outline-variant bg-surface-container-low flex flex-col p-4 space-y-2 z-50">
            <div class="px-4 py-6 mb-4">
                <h1 class="font-black text-on-surface text-xl tracking-tight">TaskFlow</h1>
                <p class="text-xs text-outline">{{ ucfirst(Auth::user()->role) }} Workspace</p>
            </div>
            <nav class="flex-1 space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('dashboard') ? 'bg-primary-container text-white' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-lg font-semibold transition-all">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md">Dashboard</span>
                </a>
                <a href="{{ route('projects.index') }}" class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('projects.*') ? 'bg-primary-container text-white' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-lg font-semibold transition-all">
                    <span class="material-symbols-outlined">folder_shared</span>
                    <span class="font-label-md">Projects</span>
                </a>
                <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('tasks.*') ? 'bg-primary-container text-white' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-lg font-semibold transition-all">
                    <span class="material-symbols-outlined">assignment_turned_in</span>
                    <span class="font-label-md">Tasks</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('profile.edit') ? 'bg-primary-container text-white' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-lg font-semibold transition-all">
                    <span class="material-symbols-outlined">account_circle</span>
                    <span class="font-label-md">My Profile</span>
                </a>
                @if(Auth::user()->isAdmin())
                <a href="{{ route('team.index') }}" class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('team.*') ? 'bg-primary-container text-white' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-lg font-semibold transition-all">
                    <span class="material-symbols-outlined">group</span>
                    <span class="font-label-md">Team</span>
                </a>
                @endif
            </nav>
            <div class="pt-4 border-t border-outline-variant space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-lg transition-all">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="font-label-md">Logout</span>
                    </a>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="ml-64 min-h-screen flex flex-col">
            <!-- TopAppBar -->
            <header class="sticky top-0 w-full flex justify-between items-center px-6 h-16 bg-white border-b border-outline-variant z-40 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="text-xl font-bold text-primary tracking-tight font-h3">TaskFlow</span>
                    <div class="relative ml-8 hidden md:block">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-base">search</span>
                        <input class="bg-surface-container-low border-none rounded-full py-2 pl-10 pr-4 text-sm w-64 focus:ring-2 focus:ring-primary focus:bg-white transition-all" placeholder="Search tasks..." type="text"/>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-full transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="h-8 w-px bg-outline-variant mx-2"></div>
                    <div class="flex items-center gap-3 pl-2">
                        <div class="text-right hidden sm:block">
                            <p class="font-label-md text-on-surface">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-outline uppercase tracking-wider font-bold">{{ Auth::user()->role }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold overflow-hidden">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAPp-ijJBCFzOdUZMEFpJjzivJu-ijjMAI4x5YUtYqhBr34v1pU9ByU9BGR7GkJ2b3dhN7nnafZd72rsRTWs4-teCQtGeeaOsRyZytGOfOsGEXohQKDOTl1yEreRZQsohJka0B8F0TCDr4FI63YN4ShRLaBI0gA7bpRBiKnI2ZdIMFwxLvjWVRXRk2vUmdVWO63pKRAa8jL5Y_TyT45OUSE43gSxBNLWIXc0Skn52umKml2WzVH8mlSqM0a7B44E78N_1t7FIY44JXP" alt="User" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-8 max-w-7xl mx-auto w-full">
                {{ $slot }}
            </div>
        </main>

        <!-- Notification Toasts (Fixed) -->
        <div class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 w-full max-w-sm">
            @if(session('success'))
                <div class="auto-dismiss flex items-center gap-3 p-4 bg-white border-l-4 border-emerald-500 rounded-xl shadow-2xl shadow-indigo-100/50 transition-all duration-500 translate-x-0">
                    <div class="w-8 h-8 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600">
                        <span class="material-symbols-outlined text-xl">check_circle</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-on-surface">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="auto-dismiss flex items-center gap-3 p-4 bg-white border-l-4 border-rose-500 rounded-xl shadow-2xl shadow-indigo-100/50 transition-all duration-500 translate-x-0">
                    <div class="w-8 h-8 bg-rose-50 rounded-full flex items-center justify-center text-rose-600">
                        <span class="material-symbols-outlined text-xl">error</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-on-surface">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dismissibles = document.querySelectorAll('.auto-dismiss');
                dismissibles.forEach(el => {
                    setTimeout(() => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateX(20px)';
                        setTimeout(() => el.remove(), 500);
                    }, 5000);
                });
            });
        </script>
    </body>
</html>

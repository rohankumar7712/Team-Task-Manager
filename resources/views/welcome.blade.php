<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>TaskFlow - Manage your team's tasks with ease</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }
    </style>
</head>
<body class="bg-background text-on-background antialiased">
<header class="sticky top-0 w-full flex justify-between items-center px-8 h-16 bg-white border-b border-outline-variant shadow-sm z-50">
    <div class="flex items-center gap-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white shadow-md">
                <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
            </div>
            <span class="text-xl font-bold text-indigo-700 tracking-tight">TaskFlow</span>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-primary font-semibold border-b-2 border-primary py-5" href="#">Home</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors px-2 py-1 rounded" href="#features">Features</a>
        </nav>
    </div>
    <div class="flex items-center gap-6">
        <div class="h-6 w-px bg-outline-variant"></div>
        @auth
            <a href="{{ url('/dashboard') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-primary-container transition-all shadow-md">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-primary-container transition-all shadow-md">Login</a>
        @endauth
    </div>
</header>

<main>
    <!-- Hero Section -->
    <section class="relative pt-24 pb-20 px-8">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="z-10 max-w-xl">
                <span class="inline-block py-1.5 px-4 rounded-full bg-primary-fixed text-on-primary-fixed font-bold text-xs uppercase tracking-wider mb-6">
                    Enterprise Workspace
                </span>
                <h1 class="font-h1 text-h1 text-on-surface leading-[1.1] mb-8">
                    Manage your team's tasks with ease
                </h1>
                <p class="font-body-lg text-on-surface-variant mb-10">
                    A powerful tool to track projects, assign tasks, and monitor progress. Built for high-velocity teams who demand clarity and mathematical harmony in their digital workspace.
                </p>
                <div class="flex flex-wrap gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-10 py-4 bg-primary text-on-primary rounded-xl font-bold hover:bg-primary-container transition-all shadow-xl">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-10 py-4 bg-primary text-on-primary rounded-xl font-bold hover:bg-primary-container transition-all shadow-xl">
                            Login to Workspace
                        </a>
                    @endauth
                    <a href="#" class="px-10 py-4 bg-white border border-outline-variant text-on-surface rounded-xl font-bold hover:bg-surface-container-low transition-all">
                        Request Demo
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -right-20 -top-20 w-[600px] h-[600px] bg-primary-container/5 rounded-full blur-[100px]"></div>
                <div class="relative bg-white rounded-[2rem] shadow-2xl p-4 border border-outline-variant overflow-hidden group">
                    <img alt="Dashboard Preview" class="w-full rounded-[1.5rem] shadow-inner" src="{{ asset('hero_taskstream_dashboard_1777724037262.png') }}"/>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-surface-container-lowest">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-20">
                <p class="text-primary font-bold uppercase tracking-widest text-sm mb-4">Streamline Your Workflow</p>
                <h2 class="font-h2 text-on-surface mb-6">Precision tools designed for the modern enterprise</h2>
                <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto">Ensure every detail is accounted for in your project lifecycle with our integrated management suite.</p>
            </div>

            <div class="bento-grid">
                <!-- Project Tracking -->
                <div class="col-span-12 md:col-span-8 bg-white border border-outline-variant rounded-3xl p-10 hover:shadow-xl transition-all group overflow-hidden">
                    <div class="flex items-start justify-between mb-8">
                        <div class="h-14 w-14 bg-primary-container rounded-2xl flex items-center justify-center text-on-primary-container shadow-lg">
                            <span class="material-symbols-outlined text-3xl">folder_shared</span>
                        </div>
                        <span class="text-primary font-bold text-xs uppercase tracking-widest">Most Popular</span>
                    </div>
                    <h3 class="font-h3 text-on-surface mb-4">Project Tracking</h3>
                    <p class="font-body-md text-on-surface-variant mb-8 leading-relaxed">Monitor every milestone and deadline with our advanced tracking system. Get real-time updates on project health.</p>
                    <div class="rounded-2xl overflow-hidden border border-outline-variant shadow-lg h-64">
                        <img alt="Project Tracking" class="w-full h-full object-cover" src="{{ asset('project_tracking_roadmap_1777724192824.png') }}"/>
                    </div>
                </div>

                <!-- Task Assignments -->
                <div class="col-span-12 md:col-span-4 bg-white border border-outline-variant rounded-3xl p-10 hover:shadow-xl transition-all shadow-sm">
                    <div class="h-14 w-14 bg-secondary-container rounded-2xl flex items-center justify-center text-on-secondary-container mb-8">
                        <span class="material-symbols-outlined text-3xl">assignment_turned_in</span>
                    </div>
                    <h3 class="font-h3 text-on-surface mb-4">Task Assignments</h3>
                    <p class="font-body-md text-on-surface-variant leading-relaxed">Delegate with confidence. Assign tasks with clear priorities and custom checkmarks for completion tracking.</p>
                </div>

                <!-- Team Management -->
                <div class="col-span-12 md:col-span-4 bg-white border border-outline-variant rounded-3xl p-10 hover:shadow-xl transition-all shadow-sm">
                    <div class="h-14 w-14 bg-tertiary-container rounded-2xl flex items-center justify-center text-on-tertiary-container mb-8">
                        <span class="material-symbols-outlined text-3xl">group</span>
                    </div>
                    <h3 class="font-h3 text-on-surface mb-4">Team Management</h3>
                    <p class="font-body-md text-on-surface-variant leading-relaxed">Centralize communication. Manage team roles, permissions, and workloads in a single unified workspace.</p>
                </div>

                <!-- CTA Banner -->
                <div class="col-span-12 md:col-span-8 bg-primary rounded-3xl p-10 relative overflow-hidden flex flex-col justify-center text-on-primary">
                    <div class="relative z-10">
                        <h3 class="font-h3 text-h3 mb-4">Ready to boost productivity?</h3>
                        <p class="text-primary-fixed text-lg mb-8 max-w-md">Join over 10,000 teams managing their tasks with TaskFlow's precision architecture.</p>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-white text-primary px-8 py-4 rounded-xl font-bold hover:bg-surface-container-low transition-all inline-block">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-white text-primary px-8 py-4 rounded-xl font-bold hover:bg-surface-container-low transition-all inline-block">Login Now</a>
                        @endauth
                    </div>
                    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-white border-t border-outline-variant py-20">
    <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16">
        <div class="space-y-6">
            <span class="text-2xl font-bold text-primary">TaskFlow</span>
            <p class="font-body-md text-on-surface-variant leading-relaxed">Building the future of team collaboration with precision and clarity. Your workspace, refined.</p>
        </div>
        <div>
            <h4 class="font-bold text-on-surface mb-6">Product</h4>
            <ul class="space-y-4 text-on-surface-variant">
                <li><a href="#" class="hover:text-primary transition-colors">Features</a></li>
                <li><a href="#" class="hover:text-primary transition-colors">Integrations</a></li>
                <li><a href="#" class="hover:text-primary transition-colors">Enterprise</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold text-on-surface mb-6">Support</h4>
            <ul class="space-y-4 text-on-surface-variant">
                <li><a href="#" class="hover:text-primary transition-colors">Help Center</a></li>
                <li><a href="#" class="hover:text-primary transition-colors">Security</a></li>
                <li><a href="#" class="hover:text-primary transition-colors">Status</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold text-on-surface mb-6">Legal</h4>
            <ul class="space-y-4 text-on-surface-variant">
                <li><a href="#" class="hover:text-primary transition-colors">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-primary transition-colors">Terms of Service</a></li>
            </ul>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-8 mt-20 pt-8 border-t border-outline-variant flex justify-between items-center text-sm text-outline">
        <span>© 2024 TaskFlow Inc. All rights reserved.</span>
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">language</span>
            <span>English (US)</span>
        </div>
    </div>
</footer>
</body>
</html>

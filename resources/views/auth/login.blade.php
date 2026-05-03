<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - TaskFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcf8ff;
        }
        .login-card-shadow {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-[#fcf8ff] text-on-surface antialiased min-h-screen flex flex-col relative">
    <!-- Background Image integrated into background -->
    <div class="fixed inset-0 -z-10 opacity-30 pointer-events-none">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-indigo-100 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-gradient-to-tr from-indigo-50 to-transparent"></div>
        <img class="w-full h-full object-cover grayscale opacity-5" alt="Background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB273PTA-RUCGnAuxK5Ej7hLe6-19eaubb3Ny6n-6PQtBdhkAYdAzb2zRA3u-rAC1lgh8NeNPLL5HOQJsUPyHvFDsSosI55Bn3VgsA9rrbdLSa4D4H5GqQ1U8DI_vscbmViVyV0KToaVUFKj0VvGUtQb3M_6VrdN-E9s51QhOVU_e2WnC6eKFLSIt3Hb50WmCQjGWDrFbRtx4k0UPktOOFK13OzsyB195UCcaoTpfUeHxjh657P-NNYp6uOnD3gquI9UnwPvH8DEHy5"/>
    </div>

    <!-- Primary Canvas -->
    <main class="flex-grow flex items-center justify-center p-8 py-12">
        <div class="w-full max-w-md space-y-8">
            <!-- Brand Anchor -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <div class="w-14 h-14 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
                </div>
                <h1 class="text-4xl font-black text-indigo-700 tracking-tight">TaskFlow</h1>
                <p class="text-slate-500 font-medium">Manage your enterprise workflow with precision.</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white border border-slate-100 rounded-[2rem] login-card-shadow p-10 space-y-8">
                <div class="space-y-2">
                    <h2 class="text-2xl font-bold text-slate-900">Welcome back</h2>
                    <p class="text-sm text-slate-500 font-medium">Enter your credentials to access your workspace.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700" for="email">Email Address</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl font-medium text-slate-900 focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 outline-none transition-all duration-200" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@company.com" type="email"/>
                        </div>
                        @error('email')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-bold text-slate-700" for="password">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-bold text-indigo-600 hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl font-medium text-slate-900 focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 outline-none transition-all duration-200" id="password" name="password" required placeholder="••••••••" type="password"/>
                        </div>
                        @error('password')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Options -->
                    <div class="flex items-center space-x-2">
                        <input class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-600 cursor-pointer" id="remember" name="remember" type="checkbox"/>
                        <label class="text-sm text-slate-500 font-medium cursor-pointer" for="remember">Keep me logged in for 30 days</label>
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-base py-4 rounded-xl shadow-lg shadow-indigo-100 active:scale-[0.98] transition-all duration-150 flex items-center justify-center gap-2" type="submit">
                        <span>Sign In to TaskFlow</span>
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </button>
                </form>

                <!-- Social Divider -->
            </div>
        </div>
    </main>

    <!-- Global Footer -->
    <footer class="w-full py-10 mt-auto border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="text-xs font-bold text-slate-400">© 2024 TaskFlow Inc. All rights reserved.</span>
            <div class="flex gap-6">
                <a class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors" href="#">Privacy Policy</a>
                <a class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors" href="#">Terms of Service</a>
                <a class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors" href="#">Security</a>
                <a class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors" href="#">Status</a>
            </div>
        </div>
    </footer>
</body>
</html>

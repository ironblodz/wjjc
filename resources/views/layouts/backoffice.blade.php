<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WJJC BackOffice') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .navbar-top {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 70px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 40;
            box-shadow: 0 4px 20px 0 rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .navbar-logo {
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
        }
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-left: 2rem;
        }
        .navbar-link {
            display: flex;
            align-items: center;
            color: #374151;
            font-weight: 500;
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        .navbar-link i {
            margin-right: 0.5rem;
            font-size: 1rem;
            transition: transform 0.3s ease;
        }
        .navbar-link.active, .navbar-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        .navbar-link:hover i {
            transform: scale(1.1);
        }
        .navbar-avatar {
            margin-left: auto;
            width: 45px; height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(124,58,237,0.25);
            transition: all 0.3s ease;
        }
        .navbar-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(124,58,237,0.35);
        }
        .navbar-mobile-menu {
            display: none;
        }
        @media (max-width: 1024px) {
            .navbar-top { padding: 0 1rem; }
            .navbar-links { gap: 1rem; margin-left: 1rem; }
        }
        @media (max-width: 768px) {
            .navbar-links { display: none; }
            .navbar-mobile-menu { display: block; margin-left: 1rem; }
        }
        .mobile-menu-panel {
            position: fixed;
            top: 70px; left: 0; right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            z-index: 50;
            display: none;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .mobile-menu-panel.open {
            display: block;
        }
        .main-content-navbar {
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        @media (max-width: 768px) {
            .main-content-navbar { padding: 1rem; }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }

        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* Button styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navbar Horizontal -->
        <nav class="navbar-top">
            <span class="navbar-logo">
                <i class="fas fa-camera text-2xl mr-3"></i> WJJC Admin
            </span>
            <div class="navbar-links">
                <a href="{{ route('backoffice.admin.dashboard') }}" class="navbar-link {{ request()->routeIs('backoffice.admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('backoffice.admin.photos.index') }}" class="navbar-link {{ request()->routeIs('backoffice.admin.photos.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i> Eventos
                </a>
                <a href="{{ route('backoffice.admin.categories.index') }}" class="navbar-link {{ request()->routeIs('backoffice.admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Categorias
                </a>
                <a href="{{ route('backoffice.admin.logs.index') }}" class="navbar-link {{ request()->routeIs('backoffice.admin.logs.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> Logs
                </a>
                <a href="{{ route('backoffice.admin.commands.index') }}" class="navbar-link {{ request()->routeIs('backoffice.admin.commands.*') ? 'active' : '' }}">
                    <i class="fas fa-terminal"></i> Comandos
                </a>
                <a href="{{ route('profile.edit') }}" class="navbar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-cog"></i> Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="navbar-link hover:text-red-400" style="background:none;border:none;cursor:pointer;">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
            <!-- Mobile menu button -->
            <button class="navbar-mobile-menu text-gray-500 hover:text-gray-700 focus:outline-none transition-colors duration-200" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-2xl"></i>
            </button>
            <div class="navbar-avatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </nav>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu-panel" class="mobile-menu-panel">
            <a href="{{ route('backoffice.admin.dashboard') }}" class="block px-6 py-4 navbar-link {{ request()->routeIs('backoffice.admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('backoffice.admin.photos.index') }}" class="block px-6 py-4 navbar-link {{ request()->routeIs('backoffice.admin.photos.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Eventos
            </a>
            <a href="{{ route('backoffice.admin.categories.index') }}" class="block px-6 py-4 navbar-link {{ request()->routeIs('backoffice.admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Categorias
            </a>
            <a href="{{ route('backoffice.admin.logs.index') }}" class="block px-6 py-4 navbar-link {{ request()->routeIs('backoffice.admin.logs.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Logs
            </a>
            <a href="{{ route('backoffice.admin.commands.index') }}" class="block px-6 py-4 navbar-link {{ request()->routeIs('backoffice.admin.commands.*') ? 'active' : '' }}">
                <i class="fas fa-terminal"></i> Comandos
            </a>
            <a href="{{ route('profile.edit') }}" class="block px-6 py-4 navbar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i> Perfil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block px-6 py-4">
                @csrf
                <button type="submit" class="navbar-link hover:text-red-400 w-full text-left" style="background:none;border:none;cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <main class="main-content-navbar">
            @if (session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <span class="text-green-700 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                        </div>
                        <span class="text-red-700 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
        <x-toast />
        @stack('scripts')
    </div>

    <script>
        function toggleMobileMenu() {
            const panel = document.getElementById('mobile-menu-panel');
            panel.classList.toggle('open');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const panel = document.getElementById('mobile-menu-panel');
            const mobileButton = document.querySelector('.navbar-mobile-menu');

            if (!panel.contains(event.target) && !mobileButton.contains(event.target)) {
                panel.classList.remove('open');
            }
        });
    </script>
</body>

</html>

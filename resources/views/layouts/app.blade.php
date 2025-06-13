<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Naw\'s Patrol') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        @stack('styles')
        
        <style>
        /* Custom Styles for Naw's Patrol */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fafafa;
        }

        .hero-section {
            background-color: #1B2B44;
            padding: 0;
            position: relative;
            overflow: hidden;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            min-height: 400px;
            background-image: url('/img/paw.png');
            background-repeat: no-repeat;
            background-position: center bottom -800px;
            background-size: 150px;
            opacity: 0.9;
        }
        .nav-container {
            position: relative;
            z-index: 20;
            padding: 1rem;
        }

        .nav-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-brand:hover {
            color: #facc15;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            padding: 16px 32px;
            gap: 32px;
            background-color: transparent;
            position: relative;
            z-index: 3;
            justify-content: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-size: 14px;
            opacity: 0.7;
            transition: opacity 0.3s;
            font-weight: 500;
        }

        .nav-link:hover {
            opacity: 1;
        }

        .nav-link.active {
            opacity: 1;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1rem;
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            min-height: 50vh;
        }

        .hero-text {
            max-width: 50%;
            z-index: 15;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .paw-background {
            width: 2100px;
            height: 1000px;
            margin-top: -600px;
            margin-left: -465px;
            min-height: 400px;
            background-image: url('/image/paw.png');
            background-repeat: no-repeat;
            background-position: center bottom -800px;
            background-size: 1350px;
            background-color: #1B2B44;
            padding: 0;
            position:absolute;
            overflow: hidden;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .paw-svg {
            opacity: 0;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: flex;
                padding: 16px 32px;
                gap: 32px;
                background-color: transparent;
                position: relative;
                z-index: 3;
                justify-content: center;
            }

            .nav-menu.active {
                display: flex;
            }

            .hero-content {
                flex-direction: column;
                text-align: center;
                padding: 2rem 1rem;
            }

            .hero-text {
                max-width: 100%;
                margin-bottom: 2rem;
            }

            .hero-title {
                color: white;
                margin-top: 100px;
                margin-left: 50px;
            }

            .hero-subtitle {
                color: white;
                margin-top: 70px;
                margin-left: 50px;
            }

            .paw-background {
                position: relative;
                width: 80%;
                height: 200px;
                right: auto;
                top: auto;
                transform: none;
                margin: 0 auto;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .nav-wrapper {
                flex-direction: column;
                gap: 1rem;
            }

            .main-content {
                padding: 1rem 0.5rem;
            }
        }
        </style>
    </head>
    <body>
        <div class="min-h-screen">
            <!-- Hero Section with Navigation -->
            <div class="hero-section">
                <!-- Navigation -->

                <nav class="relative z-10 p-4">
                    <div class="container mx-auto">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('dashboard') }}" class="text-white text-2xl font-bold">Naw's Patrol</a>
                            <div class="flex space-x-6">
                                <a href="{{ route('profile') }}" class="text-white hover:text-yellow-400 {{ request()->routeIs('profile') ? 'text-yellow-400' : '' }}">Profile</a>
                                <a href="#" class="text-white hover:text-yellow-400">Adoptions</a>
                                <a href="#" class="text-white hover:text-yellow-400">Foster Home</a>
                                <a href="{{ route('animal-report.index') }}" class="text-white hover:text-yellow-400">Stray Animal Report</a>
                                <a href="{{ route('donations.index') }}" class="text-white hover:text-yellow-400 {{ request()->routeIs('donations.*') ? 'text-yellow-400' : '' }}">Donations</a>
                                <a href="{{ route('educations.index') }}" class="text-white hover:text-yellow-400">Educations</a>
                            </div>
                <nav class="nav-container">
                    <div class="nav-wrapper">
                        <a href="{{ route('dashboard') }}" class="nav-brand">Naw's Patrol</a>
                        <div class="nav-menu">
                            <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile*') ? 'active' : '' }}">Profile</a>
                            <a href="{{ route('adopt.index') }}" class="nav-link {{ request()->routeIs('adopt*') ? 'active' : '' }}">Adoption</a>
                            <a href="{{ route('fosterHome.form') }}" class="nav-link {{ request()->routeIs('fosterHome*') ? 'active' : '' }}">Foster Home</a>
                            <a href="#" class="nav-link">Stray Animal Report</a>
                            <a href="{{ route('donations.index') }}" class="nav-link {{ request()->routeIs('donations.*') ? 'active' : '' }}">Donations</a>
                            <a href="#" class="nav-link">Educations</a>
                        </div>
                    </div>
                </nav>

                <!-- Hero Content -->
                <div class="hero-content">
                    <!-- Hero Text -->
                    <div class="hero-text">
                        <h1 class="hero-title">Naw's Patrol</h1>
                        <p class="hero-subtitle">A system designed to address the issue of stray animals in Indonesia especially cats and dogs.</p>
                    </div>

                    <!-- Large Paw Print Background -->
                    <div class="paw-background">
                        <svg viewBox="0 0 512 512" class="paw-svg">
                            <path fill="currentColor" d="M256 224c-79.41 0-192 122.76-192 200.25 0 34.9 26.81 55.75 71.74 55.75 48.84 0 81.09-25.08 120.26-25.08 39.51 0 71.85 25.08 120.26 25.08 44.93 0 71.74-20.85 71.74-55.75C448 346.76 335.41 224 256 224zm-147.28-12.61c-10.4-34.65-42.44-57.09-71.56-50.13-29.12 6.96-44.29 40.69-33.89 75.34 10.4 34.65 42.44 57.09 71.56 50.13 29.12-6.96 44.29-40.69 33.89-75.34zm84.72-20.78c30.94-8.14 46.42-49.94 34.58-93.36s-46.52-72.01-77.46-63.87-46.42 49.94-34.58 93.36c11.84 43.42 46.53 72.02 77.46 63.87zm281.39-29.34c-29.12-6.96-61.15 15.48-71.56 50.13-10.4 34.65 4.77 68.38 33.89 75.34 29.12 6.96 61.15-15.48 71.56-50.13 10.4-34.65-4.77-68.38-33.89-75.34zm-156.27 29.34c30.94 8.14 65.62-20.45 77.46-63.87 11.84-43.42-3.64-85.21-34.58-93.36s-65.62 20.45-77.46 63.87c-11.84 43.42 3.64 85.22 34.58 93.36z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
        </div>

        @stack('scripts')
    </body>
</html>

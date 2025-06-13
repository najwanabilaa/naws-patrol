<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Naw\'s Patrol') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @stack('styles')
        
        <style>
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
            min-height: 200px;
            background-image: url('{{ asset("image/paw.png") }}');
            background-repeat: no-repeat;
            background-position: center 30%;
            background-size: 1380px;

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
            opacity: 0;
        }

        .nav-brand:hover {
            color: #facc15;
            text-decoration: none;
            opacity: 0;
        }

        .nav-menu {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: #facc15;
            text-decoration: none;
        }

        .nav-link.active {
            color: #facc15;
            background-color: rgba(250, 204, 21, 0.1);
        }

        .hero-content {
            max-width: 5000px;
            margin: 0 auto;
            padding: 3rem 1rem;
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            max-height: 200px;

        }

        .hero-text {
            max-width: 60%;
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

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        @media (max-width: 768px) {
            .nav-wrapper {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 16px;
            }

            .hero-content {
                flex-direction: column;
                text-align: center;
                padding: 2rem 1rem;
            }

            .hero-text {
                max-width: 100%;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .main-content {
                padding: 1rem 0.5rem;
            }
        }
        </style>
    </head>
    <body>
        <div class="min-h-screen">
            <div class="hero-section">
                <nav class="nav-container">
                    <div class="nav-wrapper">
                        <a href="{{ route('dashboard') }}" class="nav-brand">Naw's Patrol</a>
                        <div class="nav-menu">
                            <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile*') ? 'active' : '' }}">Profile</a>
                            <a href="{{ route('adopt.index') }}" class="nav-link {{ request()->routeIs('adopt*') ? 'active' : '' }}">Adoption</a>
                            <a href="{{ route('foster.landing') }}" class="nav-link {{ request()->routeIs('fosterHome*') ? 'active' : '' }}">Foster Home</a>
                            <a href="{{ route('animal-report.index') }}" class="nav-link {{ request()->routeIs('animal-report*') ? 'active' : '' }}">Stray Animal Report</a>
                            <a href="{{ route('donations.index') }}" class="nav-link {{ request()->routeIs('donations.*') ? 'active' : '' }}">Donations</a>
                            <a href="{{ route('educations.index') }}" class="nav-link {{ request()->routeIs('educations*') ? 'active' : '' }}">Educations</a>
                        </div>
                    </div>
                </nav>

                <div class="hero-content">
                    <div class="hero-text">
                        <h1 href="{{ route('dashboard') }}" class="hero-title">Naw's Patrol</h1>
                        <p class="hero-subtitle">A system designed to address the issue of stray animals in Indonesia especially cats and dogs.</p>
                    </div>
                </div>
            </div>

            <div class="main-content">
                @yield('content')
            </div>
        </div>

        @stack('scripts')
    </body>
</html>

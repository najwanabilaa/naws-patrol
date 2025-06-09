<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Naw\'s Patrol') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        @stack('styles')
    </head>
    <body class="bg-white">
        <div class="min-h-screen">
            <!-- Hero Section with Navigation -->
            <div class="relative bg-gray-900 overflow-hidden">
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
                        </div>
                    </div>
                </nav>

                <!-- Hero Content -->
                <div class="container mx-auto px-4 py-12 relative">
                    <!-- Large Paw Print Background -->
                    <div class="absolute right-0 top-0 w-3/4 h-full opacity-20">
                        <svg viewBox="0 0 512 512" class="w-full h-full text-yellow-400 transform rotate-12">
                            <path fill="currentColor" d="M256 224c-79.41 0-192 122.76-192 200.25 0 34.9 26.81 55.75 71.74 55.75 48.84 0 81.09-25.08 120.26-25.08 39.51 0 71.85 25.08 120.26 25.08 44.93 0 71.74-20.85 71.74-55.75C448 346.76 335.41 224 256 224zm-147.28-12.61c-10.4-34.65-42.44-57.09-71.56-50.13-29.12 6.96-44.29 40.69-33.89 75.34 10.4 34.65 42.44 57.09 71.56 50.13 29.12-6.96 44.29-40.69 33.89-75.34zm84.72-20.78c30.94-8.14 46.42-49.94 34.58-93.36s-46.52-72.01-77.46-63.87-46.42 49.94-34.58 93.36c11.84 43.42 46.53 72.02 77.46 63.87zm281.39-29.34c-29.12-6.96-61.15 15.48-71.56 50.13-10.4 34.65 4.77 68.38 33.89 75.34 29.12 6.96 61.15-15.48 71.56-50.13 10.4-34.65-4.77-68.38-33.89-75.34zm-156.27 29.34c30.94 8.14 65.62-20.45 77.46-63.87 11.84-43.42-3.64-85.21-34.58-93.36s-65.62 20.45-77.46 63.87c-11.84 43.42 3.64 85.22 34.58 93.36z"/>
                        </svg>
                    </div>

                    <!-- Hero Text -->
                    <div class="relative z-10 max-w-2xl">
                        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">Naw's Patrol</h1>
                        <p class="text-xl text-white mb-8">A system designed to address the issue of stray animals in Indonesia especially cats and dogs.</p>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="container mx-auto px-4 py-8">
                @yield('content')
            </div>
        </div>

        @stack('scripts')
    </body>
</html>

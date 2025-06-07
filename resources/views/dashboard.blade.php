@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8 -mt-16 relative z-10">
    <!-- Adoption Category Section -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold mb-8">Adoption Category</h2>
        <p class="text-gray-600 mb-8">Search for the Animal Category You Want to Adopt</p>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Cats -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4 hover:shadow-lg transition-shadow cursor-pointer">
                <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.5 8C5.67157 8 5 8.67157 5 9.5C5 10.3284 5.67157 11 6.5 11C7.32843 11 8 10.3284 8 9.5C8 8.67157 7.32843 8 6.5 8Z"/>
                        <path d="M13.5 8C12.6716 8 12 8.67157 12 9.5C12 10.3284 12.6716 11 13.5 11C14.3284 11 15 10.3284 15 9.5C15 8.67157 14.3284 8 13.5 8Z"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM7 13C7 12.4477 7.44772 12 8 12H12C12.5523 12 13 12.4477 13 13C13 13.5523 12.5523 14 12 14H8C7.44772 14 7 13.5523 7 13Z"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold">Cats</span>
            </div>

            <!-- Dogs -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4 hover:shadow-lg transition-shadow cursor-pointer">
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM7 8C6.44772 8 6 8.44772 6 9V11C6 11.5523 6.44772 12 7 12C7.55228 12 8 11.5523 8 11V9C8 8.44772 7.55228 8 7 8ZM12 8C11.4477 8 11 8.44772 11 9V11C11 11.5523 11.4477 12 12 12C12.5523 12 13 11.5523 13 11V9C13 8.44772 12.5523 8 12 8Z"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold">Dogs</span>
            </div>

            <!-- Birds -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4 hover:shadow-lg transition-shadow cursor-pointer">
                <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 3C6.13401 3 3 6.13401 3 10C3 13.866 6.13401 17 10 17C13.866 17 17 13.866 17 10C17 6.13401 13.866 3 10 3ZM8 7C8 6.44772 8.44772 6 9 6H11C11.5523 6 12 6.44772 12 7C12 7.55228 11.5523 8 11 8H9C8.44772 8 8 7.55228 8 7Z"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold">Birds</span>
            </div>

            <!-- Rabbits -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4 hover:shadow-lg transition-shadow cursor-pointer">
                <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM7 7C6.44772 7 6 7.44772 6 8V12C6 12.5523 6.44772 13 7 13C7.55228 13 8 12.5523 8 12V8C8 7.44772 7.55228 7 7 7ZM12 7C11.4477 7 11 7.44772 11 8V12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12V8C13 7.44772 12.5523 7 12 7Z"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold">Rabbits</span>
            </div>
        </div>
    </div>

    <!-- Help Me Find a Home Section -->
    <div>
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold">Help Me Find a <span class="text-yellow-400">Home</span></h2>
                <p class="text-gray-600 mt-2">Pet adoption is quickly becoming the preferred way to find a new dog, puppy, cat, kitten or pet.</p>
            </div>
            <a href="#" class="text-yellow-400 hover:text-yellow-500 font-semibold">View All</a>
        </div>

        <!-- Pet Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Repeat this card for each pet -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/daisy-cat.jpg') }}" alt="Daisy" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Daisy</h3>
                    <p class="text-gray-600 mb-4">Mix Jenis Anggora</p>
                    <div class="flex space-x-4">
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">1 Tahun</span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Putih Lilac</span>
                    </div>
                </div>
            </div>
            <!-- Repeat for more pets -->
        </div>
    </div>
</div>
@endsection
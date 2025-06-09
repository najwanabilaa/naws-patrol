@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Educations Article</h1>
        @auth
            <a href="{{ route('educations.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                Write an Article
            </a>
        @endauth
    </div>

    <!-- Category Filter -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('educations.index') }}" class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700' }} hover:bg-yellow-600 hover:text-white transition">
                All
            </a>
            @foreach(['Health', 'Animal care', 'Animal behavior', 'Food', 'Others'] as $category)
                <a href="{{ route('educations.index', ['category' => $category]) }}" 
                   class="px-4 py-2 rounded-full {{ request('category') === $category ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700' }} hover:bg-yellow-600 hover:text-white transition capitalize">
                    {{ $category }}
                </a>
            @endforeach
        </div>
    </div>

    @if($educations->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">There are no educational articles yet.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($educations as $education)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    @if($education->image)
                        <img src="{{ Storage::url($education->image) }}" 
                             alt="{{ $education->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm capitalize mb-2">
                            {{ $education->category }}
                        </span>
                        
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('educations.show', $education) }}" class="hover:text-yellow-600">
                                {{ $education->title }}
                            </a>
                        </h2>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($education->content), 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>Oleh: {{ $education->user->name }}</span>
                            <span>{{ $education->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $educations->links() }}
        </div>
    @endif
</div>
@endsection 
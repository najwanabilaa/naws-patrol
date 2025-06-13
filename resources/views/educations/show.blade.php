@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('educations.index') }}" class="inline-flex items-center text-gray-600 hover:text-yellow-600 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Article List
        </a>

        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-4">{{ $education->title }}</h1>
            
            <div class="flex items-center gap-4 text-gray-600 mb-4">
                <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm capitalize">
                    {{ $education->category }}
                </span>
                <span>{{ $education->created_at->format('d M Y') }}</span>
                <span>Oleh: {{ $education->user->name }}</span>
            </div>

            @if(auth()->check() && auth()->id() === $education->user_id)
                <div class="flex gap-2">
                    <a href="{{ route('educations.edit', $education) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    
                    <form action="{{ route('educations.destroy', $education) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                                onclick="return confirm('Are you sure you want to delete this article?')">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        @if($education->image)
            <div class="mb-8">
                <img src="{{ Storage::url($education->image) }}" 
                     alt="{{ $education->title }}"
                     class="w-full rounded-lg shadow-lg">
            </div>
        @endif

        <div class="prose prose-lg max-w-none">
            {!! nl2br(e($education->content)) !!}
        </div>

        <div class="mt-8 pt-8 border-t">
            <h3 class="text-lg font-semibold mb-4">Share Article</h3>
            <div class="flex gap-4">
                <a href="https://wa.me/?text={{ urlencode($education->title . ' - ' . route('educations.show', $education)) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                    <span class="mr-2">WhatsApp</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 1.856.001 3.598.723 4.907 2.034 1.31 1.311 2.031 3.054 2.03 4.908-.001 3.825-3.113 6.938-6.937 6.938z"/>
                    </svg>
                </a>
                
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('educations.show', $education)) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <span class="mr-2">Facebook</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                    </svg>
                </a>
                
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($education->title) }}&url={{ urlencode(route('educations.show', $education)) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500">
                    <span class="mr-2">Twitter</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 
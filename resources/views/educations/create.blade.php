@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold">Write Educational Articles</h1>
            <p class="text-gray-600 mt-2">Share your knowledge about animal care or anything related to animals.</p>
        </div>

        <form action="{{ route('educations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Article Title</label>
                <input type="text" name="title" id="title" 
                       class="mt-1 block w-full border-2 border-yellow-400 rounded-lg px-3 py-2 focus:border-yellow-500 focus:ring-yellow-200"
                       value="{{ old('title') }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category" 
                        class="mt-1 block w-full border-2 border-yellow-400 rounded-lg px-3 py-2 focus:border-yellow-500 focus:ring-yellow-200">
                    <option value="">Choose Category</option>
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ old('category') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image (Optional)</label>
                <div class="mt-1 flex items-center">
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full border-2 border-yellow-400 rounded-lg px-3 py-2 focus:border-yellow-500 focus:ring-yellow-200">
                </div>
                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Max 2MB.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Konten Artikel</label>
                <textarea name="content" id="content" rows="15" required
                          class="mt-1 block w-full border-2 border-yellow-400 rounded-lg px-3 py-2 focus:border-yellow-500 focus:ring-yellow-200">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('educations.index') }}" 
                   class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
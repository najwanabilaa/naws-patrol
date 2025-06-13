@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold">Edit Educational Article</h1>
            <p class="text-gray-600 mt-2">Update your article</p>
        </div>

        <form action="{{ route('educations.update', $education) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Artikel</label>
                <input type="text" name="title" id="title" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                       value="{{ old('title', $education->title) }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                    <option value="">Choose Category</option>
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ old('category', $education->category) === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if($education->image)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Image</label>
                    <div class="mt-2">
                        <img src="{{ Storage::url($education->image) }}" 
                             alt="{{ $education->title }}"
                             class="w-48 h-48 object-cover rounded-lg">
                    </div>
                </div>
            @endif

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">
                    {{ $education->image ? 'Change Image (Optional)' : 'Add Image (Optional)' }}
                </label>
                <div class="mt-1 flex items-center">
                    <input type="file" name="image" id="image" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                </div>
                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Max 2MB.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Konten Artikel</label>
                <textarea name="content" id="content" rows="15" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">{{ old('content', $education->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('educations.show', $education) }}" 
                   class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
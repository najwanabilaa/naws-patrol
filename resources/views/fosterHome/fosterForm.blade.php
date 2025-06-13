"@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('foster.landing') }}" class="text-yellow-400 hover:text-yellow-500">← Go Back</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">Formulir Pemfosteran</h1>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8 max-w-2xl mx-auto">
        <div class="relative">
            <img src="{{ asset($animal->image_url) }}" alt="{{ $animal->name }}" class="w-full h-64 object-cover">
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black to-transparent">
                <h2 class="text-white text-xl font-bold">{{ $animal->name }}</h2>
                <div class="bg-yellow-400 w-full h-2 rounded-full mt-2">
                    <div class="bg-white w-11/12 h-full rounded-full"></div>
                </div>
                <p class="text-white mt-1">Status Kesehatan: {{ $animal->health_status }}%</p>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="flex items-center">
                    <div>
                        <p class="text-sm text-gray-500">Nama Hewan</p>
                        <p class="font-medium">{{ $animal->name }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div>
                        <p class="text-sm text-gray-500">Jenis & Ras</p>
                        <p class="font-medium">{{ $animal->breed }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div>
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="font-medium">{{ $animal->gender }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div>
                        <p class="text-sm text-gray-500">Usia</p>
                        <p class="font-medium">{{ $animal->age }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-yellow-400 rounded-lg p-6 max-w-2xl mx-auto">
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('foster.accept') }}" method="POST" class="space-y-6" id="fosterForm">
            @csrf
            <input type="hidden" name="animal_id" value="{{ $animal->id }}">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Estimasi Durasi Penampungan:</label>
                <input type="text" name="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Lokasi Penampungan:</label>
                <input type="text" name="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan Tambahan (Opsional):</label>
                <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"></textarea>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-700 mb-4">Komitmen Foster:</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <input type="checkbox" name="commitment[]" value="tempat_layak" class="mt-1 h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500" required>
                        <label class="ml-3 text-sm text-gray-600">
                            Saya bersedia memberikan tempat tinggal yang layak
                        </label>
                    </div>
                    <div class="flex items-start">
                        <input type="checkbox" name="commitment[]" value="laporan_berkala" class="mt-1 h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500" required>
                        <label class="ml-3 text-sm text-gray-600">
                            Saya akan mengisi laporan perkembangan secara berkala
                        </label>
                    </div>
                    <div class="flex items-start">
                        <input type="checkbox" name="commitment[]" value="tidak_memberikan" class="mt-1 h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500" required>
                        <label class="ml-3 text-sm text-gray-600">
                            Saya tidak akan memberikan hewan ini kepada pihak lain tanpa izin shelter
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="submitBtn">
                    Ajukan Sebagai Foster
                </button>
                <button type="button" onclick="window.history.back()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Batalkan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const checkboxes = document.querySelectorAll('input[name="commitment[]"]');
    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
    
    if (!allChecked) {
        e.preventDefault();
        alert('Anda harus menyetujui semua komitmen foster untuk melanjutkan.');
        return;
    }

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Memproses...';
});
</script>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endpush

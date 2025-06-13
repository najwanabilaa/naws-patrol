@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Wildlife Report Details</h2>
                    <a href="{{ route('animal-report.index') }}" class="text-blue-600 hover:text-blue-900">
                        &larr; Back to List
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Report Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="mb-2"><span class="font-medium">Name:</span> {{ $report->nama_lengkap }}</p>
                                <p class="mb-2"><span class="font-medium">Phone Number:</span> {{ $report->nomor_hp }}</p>
                                <p class="mb-2"><span class="font-medium">Address:</span> {{ $report->alamat }}</p>
                                <p class="mb-2"><span class="font-medium">Report Date:</span> {{ $report->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Reason for Reporting</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p>{{ $report->alasan_melapor }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Report Status</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                    @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($report->status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($report->status === 'completed') bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Animal Photo</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                @if($report->foto)
                                    <img src="{{ Storage::url($report->foto) }}" 
                                         alt="Animal Photo" 
                                         class="w-full rounded-lg shadow-lg">
                                @else
                                    <p class="text-gray-500">No photo</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-2">Location</h3>
                            <div id="map" class="w-full h-64 rounded-lg border-2 border-gray-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&callback=initMap" async defer></script>
<script>
    function initMap() {
        const location = { 
            lat: {{ $report->latitude }}, 
            lng: {{ $report->longitude }} 
        };
        
        const map = new google.maps.Map(document.getElementById("map"), {
            center: location,
            zoom: 15,
            mapTypeControl: true,
            streetViewControl: true,
            zoomControl: true,
        });

        const marker = new google.maps.Marker({
            position: location,
            map: map,
            animation: google.maps.Animation.DROP
        });
    }
</script>
@endpush
@endsection 

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush
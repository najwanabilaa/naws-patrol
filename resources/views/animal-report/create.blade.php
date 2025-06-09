@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Lapor Hewan Liar</h2>
                
                @include('animal-report.form')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&callback=initMap" async defer></script>
<script>
    let map;
    let marker;

    function initMap() {
        // Default to center of Indonesia
        const defaultLocation = { lat: -6.200000, lng: 106.816666 };
        
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 13,
            mapTypeControl: true,
            streetViewControl: true,
            zoomControl: true,
        });

        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP
        });

        // Try to get user's location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    map.setCenter(pos);
                    marker.setPosition(pos);
                    updateCoordinates(pos);
                },
                () => {
                    // Handle location error
                    console.log('Error: The Geolocation service failed.');
                }
            );
        }

        // Update coordinates when marker is dragged
        google.maps.event.addListener(marker, 'dragend', function() {
            updateCoordinates(marker.getPosition());
        });

        // Click on map to move marker
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
            updateCoordinates(event.latLng);
        });
    }

    function updateCoordinates(position) {
        document.getElementById('latitude').value = position.lat();
        document.getElementById('longitude').value = position.lng();
    }
</script>
@endpush 
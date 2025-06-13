@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Stray Animal Report</h2>
                
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
                    console.log('Error: The Geolocation service failed.');
                }
            );
        }

        google.maps.event.addListener(marker, 'dragend', function() {
            updateCoordinates(marker.getPosition());
        });

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

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush
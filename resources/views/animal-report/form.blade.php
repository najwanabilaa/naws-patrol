<div class="bg-white p-6 rounded-lg shadow-md">
    <form method="POST" action="{{ route('animal-report.store') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        
        <div>
            <x-input-label for="nama_lengkap" value="Nama Lengkap" />
            <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="nomor_hp" value="Nomor HP" />
            <x-text-input id="nomor_hp" name="nomor_hp" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('nomor_hp')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="alamat" value="Alamat" />
            <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="alasan_melapor" value="Alasan Melapor" />
            <textarea id="alasan_melapor" name="alasan_melapor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3" required></textarea>
            <x-input-error :messages="$errors->get('alasan_melapor')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="foto" value="Foto Hewan" />
            <input type="file" id="foto" name="foto" class="mt-1 block w-full" accept="image/*" required />
            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="location" value="Lokasi" />
            <div class="mt-2 mb-4">
                <input id="searchInput" class="w-full p-2 border border-gray-300 rounded-md" type="text" placeholder="Cari lokasi...">
            </div>
            <div id="map" class="w-full h-64 rounded-lg mt-2 border-2 border-gray-300"></div>
            <div id="map-error" class="hidden mt-2 text-red-600 text-sm"></div>
            <input type="hidden" id="latitude" name="latitude" required>
            <input type="hidden" id="longitude" name="longitude" required>
        </div>

        <div class="flex justify-end">
            <x-primary-button>
                Laporkan
            </x-primary-button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function initMap() {
        try {
            // Default to Bandung's coordinates
            const defaultLocation = { lat: -6.914744, lng: 107.609810 };
            
            const map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13,
                mapTypeControl: true,
                streetViewControl: true,
                zoomControl: true,
                fullscreenControl: true,
                gestureHandling: 'greedy'
            });

            const marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP
            });

            // Initialize Autocomplete
            const input = document.getElementById('searchInput');
            const autocomplete = new google.maps.places.Autocomplete(input, {
                componentRestrictions: { country: 'id' },
                fields: ['address_components', 'geometry', 'name', 'formatted_address']
            });

            // Bind autocomplete to map
            autocomplete.bindTo('bounds', map);

            // Listen for place selection
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    console.log("No location data for selected place");
                    return;
                }

                // Update marker and map
                marker.setPosition(place.geometry.location);
                map.setCenter(place.geometry.location);
                map.setZoom(17);

                // Update form values
                updateCoordinates(place.geometry.location);
                document.getElementById('alamat').value = place.formatted_address;
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
                        getAddressFromLatLng(pos);
                    },
                    (error) => {
                        console.log('Geolocation error:', error);
                    }
                );
            }

            // Update coordinates when marker is dragged
            marker.addListener('dragend', function() {
                const pos = marker.getPosition();
                updateCoordinates(pos);
                getAddressFromLatLng(pos);
            });

            // Click on map to move marker
            map.addListener('click', function(event) {
                marker.setPosition(event.latLng);
                updateCoordinates(event.latLng);
                getAddressFromLatLng(event.latLng);
            });

        } catch (error) {
            console.error('Error initializing map:', error);
            document.getElementById('map-error').textContent = 'Error initializing map. Please refresh the page and try again.';
            document.getElementById('map-error').classList.remove('hidden');
        }
    }

    function updateCoordinates(position) {
        document.getElementById('latitude').value = position.lat();
        document.getElementById('longitude').value = position.lng();
    }

    function getAddressFromLatLng(latLng) {
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: latLng }, (results, status) => {
            if (status === "OK" && results[0]) {
                document.getElementById('alamat').value = results[0].formatted_address;
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpLZZi6q88Hnag3KrtvQ5k7Qw2tn9dfMM&libraries=places&callback=initMap" async defer></script>
@endpush 
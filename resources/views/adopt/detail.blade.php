@extends('layouts.app')

@section('content')
<div class="detail-container">
    <a href="{{ route('adopt.index') }}" class="back-button">&lt; Back to Adoption List</a>
    
    <div class="main-image">
        <img id="petImage" src="{{ asset($pet['image'] ?? 'image/anjing.png') }}" alt="{{ $pet['name'] ?? 'Pet Image' }}" />
    </div>
    
    <div class="bottom-content">
        <div class="left">
            <h1 id="petName">{{ $pet['name'] ?? 'Pet Name' }}</h1>
            <p>
                <span id="petBreed">{{ $pet['breed'] ?? '-' }}</span>
                <span class="dot-separator"></span>
                <span id="petLocation">{{ $pet['location'] ?? '-' }}</span>
            </p>
            <hr />
            <p>
                <span id="petAge">{{ $pet['age'] ?? '-' }}</span>
                <span class="dot-separator"></span>
                <span id="petColor">{{ $pet['color'] ?? '-' }}</span>
                <span class="dot-separator"></span>
                <span id="petGender">{{ $pet['gender'] ?? '-' }}</span>
            </p>
            <hr />
            <h3>About <span id="petNameTitle">{{ $pet['name'] ?? 'Pet' }}</span></h3>
            <p id="petDescription">{{ $pet['description'] ?? 'Pet description not available.' }}</p>
        </div>
        <div class="right">
            <div class="adopt-box">
                <p>Interested in adopting <span id="petNameShort">{{ $pet['name'] ?? 'this pet' }}</span>?</p>
                <div class="adopt-center">
                    <button onclick="applyAdoption()">Apply for Adoption</button>
                    <a href="{{ route('adopt.terms', ['from' => 'detail', 'pet_id' => $pet['id'] ?? 0]) }}" target="_self">Terms and Conditions</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function applyAdoption() {
    const petId = {{ $pet['id'] ?? 0 }};
    window.location.href = `{{ route('adopt.form') }}?pet_id=${petId}`;
}

function showTermsConditions() {
    alert('Terms & Conditions:\n\n1. Prospective adopter must be at least 21 years old\n2. Must have stable housing\n3. Willing to be surveyed by our team\n4. Sign adoption contract\n5. Provide regular updates on pet condition');
}
</script>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/adopt/adoptDetail.css') }}" />
<style>
.back-button {
    display: inline-block;
    margin: 20px 0;
    color: #333;
    text-decoration: none;
    font-weight: bold;
}

.back-button:hover {
    color: #007bff;
}
.main-image {
    width: 200px;
    height: 300px;
}
</style>
@endpush

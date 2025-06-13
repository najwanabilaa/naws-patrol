@extends('layouts.app')

@section('content')
<div class="success-container">
    <div class="success-icon">
        <img src="{{ asset('image/ceklis.png') }}" alt="Success" />
    </div>
    <h1>Thank You!</h1>
    <p class="message">Your adoption application has been successfully submitted.</p>
    <p class="sub-message">Our team will contact you within 2x24 hours for the next process.</p>
    
    <div class="pet-info">
        <img src="{{ asset(session('pet_data')['image'] ?? 'image/kucing.jpg') }}" alt="Pet Image" class="pet-image" />
        <div class="pet-details">
            <h3>{{ session('pet_data')['name'] ?? 'Your Chosen Pet' }}</h3>
            <p>{{ session('pet_data')['breed'] ?? '' }} {{ session('pet_data')['gender'] ?? '' }} {{ session('pet_data')['age'] ?? '' }}</p>
        </div>
    </div>

    <div class="buttons">
        <a href="{{ route('adopt.status') }}" class="btn primary">View Adoption Status</a>
        <a href="{{ route('adopt.index') }}" class="btn secondary">Back to Home</a>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('css/adopt/success.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
@endpush

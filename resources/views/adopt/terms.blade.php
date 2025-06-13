@extends('layouts.app')

@section('content')
<div class="terms-wrapper">
    <div class="terms-card">
        <h2 class="terms-title">Terms and Conditions</h2>
        <ol class="terms-list">
            <li>1. Must fill out the adoption application form with accurate data.</li>
            <li>2. Provide a safe and suitable living environment for the animal.</li>
            <li>3. Commit to caring for the animal well and responsibly.</li>
            <li>4. Must not sell, abuse, or transfer the animal to others.</li>
            <li>5. Agree to sterilize if the animal has not been sterilized.</li>
            <li>6. Willing to be contacted for monitoring the animal's condition post-adoption.</li>
            <li>7. Adoption may only be done by adults as the main responsible party.</li>
        </ol>
        <div class="terms-actions">
            <a href="{{ getBackUrl() }}" class="btn-back">Back <span>&#8592;</span></a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    background: #f6f6f6;
}
.terms-wrapper {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 10px;
    background: #f6f6f6;
}
.terms-card {
    background: #fff;
    border-radius: 28px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    padding: 40px 32px 32px 32px;
    height: 450px;
    width: 800px;
    text-align: center;
}
.terms-title {
    color: #F9A825;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 28px;
    letter-spacing: 0.5px;
}
.terms-list {
    text-align: left;
    color: #F9A825;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 35px;
    padding-left: 18px;
}
.terms-list li {
    margin-bottom: 12px;
    line-height: 1.6;
}
.terms-actions {
    display: flex;
    justify-content: flex-end;
}
.btn-back {
    display: inline-block;
    background: #F9A825;
    color: #fff;
    border: none;
    border-radius: 22px;
    padding: 10px 32px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(249,168,37,0.12);
    transition: background 0.2s;
}
.btn-back:hover {
    background: #fbc02d;
    color: #fff;
    text-decoration: none;
}
@media (max-width: 600px) {
    .terms-card {
        padding: 24px 20px 20px 20px;
        max-width: 100%;
    }
    .terms-title {
        font-size: 1.2rem;
    }
    .btn-back {
        width: 100%;
        padding: 12px 0;
        font-size: 1rem;
    }
}
</style>
@endpush

@php
function getBackUrl() {
    $from = request('from');
    $petId = request('pet_id');
    
    if ($from === 'detail' && $petId) {
        return route('adopt.detail', $petId);
    }
    
    return url()->previous();
}
@endphp

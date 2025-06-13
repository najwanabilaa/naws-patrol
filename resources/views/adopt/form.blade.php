@extends('layouts.app')

@section('content')
<div class="form-container">
    <a href="{{ route('adopt.index') }}" class="back-button">&lt; Back</a>
    
    <div class="form-header">
        <h2>Adoption Form</h2>
        <p>Complete the following data to apply for adoption</p>
    </div>

    @if($pet)
    <div class="pet-info-card">
        <img src="{{ asset($pet['image']) }}" alt="{{ $pet['name'] }}" class="pet-image">
        <div class="pet-details">
            <h3>{{ $pet['name'] }}</h3>
            <p>{{ $pet['breed'] }} • {{ $pet['gender'] }} • {{ $pet['age'] }}</p>
            <p class="location">📍 {{ $pet['location'] }}</p>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('adopt.form.submit') }}" method="POST" class="adoption-form">
        @csrf
        
        @if($pet)
            <input type="hidden" name="pet_id" value="{{ $pet['id'] }}">
        @endif

        <div class="form-section">
            <h3>Your Personal Data</h3>
            
            <div class="form-group">
                <label for="full_name">Full Name <span class="required">*</span></label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
            </div>

            <div class="form-group">
                <label for="age">Age <span class="required">*</span></label>
                <input type="number" id="age" name="age" value="{{ old('age') }}" min="18" max="100" required>
                <small>Minimum 18 years old</small>
            </div>

            <div class="form-group">
                <label for="address">Full Address <span class="required">*</span></label>
                <textarea id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="house_type">House Type <span class="required">*</span></label>
                <select id="house_type" name="house_type" required>
                    <option value="">Select house type</option>
                    <option value="House" {{ old('house_type') == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Apartment" {{ old('house_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="Boarding House" {{ old('house_type') == 'Boarding House' ? 'selected' : '' }}>Boarding House</option>
                    <option value="Rental" {{ old('house_type') == 'Rental' ? 'selected' : '' }}>Rental</option>
                </select>
            </div>

            <div class="form-group">
                <label for="daily_activity">Daily Activity <span class="required">*</span></label>
                <input type="text" id="daily_activity" name="daily_activity" value="{{ old('daily_activity') }}" 
                       placeholder="Example: Office work, home in the evening" required>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Adoption <span class="required">*</span></label>
                <textarea id="reason" name="reason" rows="4" required 
                          placeholder="Tell us why you want to adopt this animal">{{ old('reason') }}</textarea>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" class="btn secondary" onclick="history.back()">Cancel</button>
            <button type="submit" class="btn primary">Apply for Adoption</button>
            <a href="{{ route('adopt.terms') }}" target="_blank">Terms and Conditions</a>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
.form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
}

.back-button {
    display: inline-block;
    margin-bottom: 20px;
    color: #666;
    text-decoration: none;
    font-weight: 600;
}

.back-button:hover {
    color: #333;
}

.form-header {
    text-align: center;
    margin-bottom: 30px;
}

.form-header h2 {
    color: #333;
    margin-bottom: 10px;
}

.pet-info-card {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
    border: 1px solid #e9ecef;
}

.pet-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    margin-right: 20px;
}

.pet-details h3 {
    margin: 0 0 5px 0;
    color: #333;
}

.pet-details p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.location {
    margin-top: 5px !important;
}

.alert {
    background: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

.adoption-form {
    background: #FAAF32;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-section h3 {
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.required {
    color: #dc3545;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #007bff;
}

.form-group small {
    display: block;
    margin-top: 5px;
    color: #666;
    font-size: 12px;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.btn {
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s;
}

.btn.primary {
    background: #007bff;
    color: white;
}

.btn.primary:hover {
    background: #0056b3;
}

.btn.secondary {
    background: #6c757d;
    color: white;
}

.btn.secondary:hover {
    background: #545b62;
}

@media (max-width: 768px) {
    .form-container {
        padding: 15px;
    }
    
    .pet-info-card {
        flex-direction: column;
        text-align: center;
    }
    
    .pet-image {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>
@endpush

@extends('layouts.app')

@section('content')
<div class="confirm-container">
    <div class="confirm-header">
        <h2>Adoption Application Confirmation</h2>
        <p>Please ensure the following data is correct before submitting your application</p>
    </div>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="confirmation-card">
        <div class="pet-section">
            <h3>Pet to be Adopted</h3>
            <div class="pet-info">
                <img src="{{ asset(session('selected_pet_data')['image'] ?? 'image/kucing.jpg') }}" alt="Pet" class="pet-image">
                <div class="pet-details">
                    <h4>{{ session('selected_pet_data')['name'] ?? '-' }}</h4>
                    <p>{{ session('selected_pet_data')['breed'] ?? '' }} • {{ session('selected_pet_data')['gender'] ?? '' }} • {{ session('selected_pet_data')['age'] ?? '' }}</p>
                    <p>📍 {{ session('selected_pet_data')['location'] ?? '' }}</p>
                </div>
            </div>
        </div>

        <div class="adopter-section">
            <h3>Prospective Adopter Data</h3>
            <div class="adopter-info">
                <div class="info-row">
                    <span class="label">Full Name:</span>
                    <span>{{ session('adoption_form_data')['full_name'] ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Age:</span>
                    <span>{{ session('adoption_form_data')['age'] ?? '-' }} years old</span>
                </div>
                <div class="info-row">
                    <span class="label">Address:</span>
                    <span>{{ session('adoption_form_data')['address'] ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">House Type:</span>
                    <span>{{ session('adoption_form_data')['house_type'] ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Daily Activity:</span>
                    <span>{{ session('adoption_form_data')['daily_activity'] ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Adoption Reason:</span>
                    <span>{{ session('adoption_form_data')['reason'] ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="terms-section">
            <div class="checkbox-group">
                <input type="checkbox" id="agreeTerms" required>
                <label for="agreeTerms">
                    I agree to the <a href="{{ route('adopt.terms') }}" target="_blank">terms and conditions</a> of adoption
                </label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="agreeResponsible" required>
                <label for="agreeResponsible">
                    I commit to caring for the animal with full responsibility
                </label>
            </div>
        </div>

        <div class="confirmation-actions">
            <button type="button" class="btn secondary" onclick="history.back()">Back</button>
            <button type="button" class="btn primary" onclick="submitAdoption()" id="submitBtn" disabled>
                Submit Application
            </button>
        </div>
    </div>
</div>

<form id="confirmForm" action="{{ route('adopt.confirm.submit') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="full_name" value="{{ session('adoption_form_data')['full_name'] ?? '' }}">
    <input type="hidden" name="age" value="{{ session('adoption_form_data')['age'] ?? '' }}">
    <input type="hidden" name="address" value="{{ session('adoption_form_data')['address'] ?? '' }}">
    <input type="hidden" name="house_type" value="{{ session('adoption_form_data')['house_type'] ?? '' }}">
    <input type="hidden" name="daily_activity" value="{{ session('adoption_form_data')['daily_activity'] ?? '' }}">
    <input type="hidden" name="reason" value="{{ session('adoption_form_data')['reason'] ?? '' }}">
    <input type="hidden" name="pet_id" value="{{ session('adoption_form_data')['pet_id'] ?? '' }}">
    <input type="hidden" name="pet_name" value="{{ session('selected_pet_data')['name'] ?? '' }}">
</form>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
.confirm-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
}

.confirm-header {
    text-align: center;
    margin-bottom: 30px;
}

.confirm-header h2 {
    color: #333;
    margin-bottom: 10px;
}

.confirmation-card {
    background: #FAAF32;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.pet-section,
.adopter-section,
.terms-section {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.pet-section:last-child,
.adopter-section:last-child,
.terms-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

h3 {
    color: #333;
    margin-bottom: 20px;
    font-size: 18px;
}

.pet-info {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
}

.pet-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    margin-right: 20px;
}

.pet-details h4 {
    margin: 0 0 5px 0;
    color: #333;
}

.pet-details p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.adopter-info {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
}

.info-row {
    display: flex;
    margin-bottom: 12px;
    align-items: flex-start;
}

.info-row:last-child {
    margin-bottom: 0;
}

.label {
    font-weight: 600;
    color: #333;
    min-width: 140px;
    flex-shrink: 0;
}

.info-row span:last-child {
    color: #666;
    word-wrap: break-word;
    flex: 1;
}

.checkbox-group {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

.checkbox-group:last-child {
    margin-bottom: 0;
}

.checkbox-group input[type="checkbox"] {
    margin-right: 10px;
    margin-top: 2px;
    flex-shrink: 0;
}

.checkbox-group label {
    color: #333;
    font-size: 14px;
    line-height: 1.5;
}

.checkbox-group a {
    color: #007bff;
    text-decoration: none;
}

.checkbox-group a:hover {
    text-decoration: underline;
}

.confirmation-actions {
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
    transition: all 0.3s;
}

.btn.primary {
    background: #007bff;
    color: white;
}

.btn.primary:hover:not(:disabled) {
    background: #0056b3;
}

.btn.primary:disabled {
    background: #6c757d;
    cursor: not-allowed;
}

.btn.secondary {
    background: #6c757d;
    color: white;
}

.btn.secondary:hover {
    background: #545b62;
}

.alert {
    background: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .confirm-container {
        padding: 15px;
    }
    
    .pet-info {
        flex-direction: column;
        text-align: center;
    }
    
    .pet-image {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .info-row {
        flex-direction: column;
        gap: 5px;
    }
    
    .label {
        min-width: auto;
    }
    
    .confirmation-actions {
        flex-direction: column;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    setupCheckboxValidation();
});

function setupCheckboxValidation() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var submitBtn = document.getElementById('submitBtn');
    
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function() {
            var allChecked = true;
            for (var j = 0; j < checkboxes.length; j++) {
                if (!checkboxes[j].checked) {
                    allChecked = false;
                    break;
                }
            }
            submitBtn.disabled = !allChecked;
        });
    }
}

function submitAdoption() {
    var submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';
    
    document.getElementById('confirmForm').submit();
}
</script>
@endpush

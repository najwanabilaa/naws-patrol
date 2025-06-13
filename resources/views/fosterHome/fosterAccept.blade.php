@extends('layouts.app')

@section('content')
<div class="foster-accept-container">
    <div class="accept-card">
        <div class="success-icon">
            <div class="check-circle">
                <i class="fas fa-check"></i>
            </div>
        </div>

        <h2 class="accept-title">Foster Application Successful!</h2>

        <div class="success-message">
            <div class="message-box">
                <i class="fas fa-check-circle message-icon"></i>
                <p class="message-text">{{ $message }}</p>
                
                @if($animalName)
                <div class="animal-info">
                    <p><strong>Animal:</strong> {{ $animalName }}</p>
                    @if($animalBreed)
                    <p><strong>Breed:</strong> {{ $animalBreed }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <div class="button-container">
            <button onclick="goToFosterLanding()" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Back to Foster Page
            </button>
        </div>
    </div>
</div>

<script>
function goToFosterLanding() {
    window.location.href = "{{ route('foster.landing') }}";
}
</script>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
.foster-accept-container {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: #f8f9fa;
    font-family: 'Poppins', sans-serif;
}

.accept-card {
    background: white;
    border-radius: 20px;
    padding: 50px 40px;
    max-width: 600px;
    width: 100%;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.6s ease-out;
}

.success-icon {
    margin-bottom: 30px;
}

.check-circle {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #4CAF50, #45a049);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
}

.check-circle i {
    color: white;
    font-size: 2rem;
    font-weight: bold;
}

.accept-title {
    color: #333;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 30px;
    line-height: 1.3;
}

.success-message {
    margin-bottom: 40px;
}

.message-box {
    background: #f0f8f0;
    border: 1px solid #d4edda;
    border-radius: 12px;
    padding: 25px;
    text-align: left;
}

.message-icon {
    color: #28a745;
    font-size: 1.2rem;
    margin-right: 10px;
}

.message-text {
    color: #155724;
    font-size: 1rem;
    line-height: 1.6;
    margin: 0 0 15px 0;
}

.animal-info {
    background: #e8f5e8;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
}

.animal-info p {
    margin: 5px 0;
    color: #2d5a2d;
    font-size: 0.9rem;
}

.button-container {
    margin-top: 30px;
}

.back-button {
    background: #007bff;
    color: white;
    border: none;
    border-radius: 25px;
    padding: 15px 30px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.back-button:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .foster-accept-container {
        padding: 20px 15px;
    }
    
    .accept-card {
        padding: 40px 25px;
    }
    
    .accept-title {
        font-size: 1.5rem;
    }
    
    .back-button {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush

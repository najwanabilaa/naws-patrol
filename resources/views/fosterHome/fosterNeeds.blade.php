@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('foster.landing') }}" class="text-yellow-400 hover:text-yellow-500">← Go Back</a>
</div>
<div class="foster-needs-container">


    <div class="header-section">
        <h1 class="main-title">Animals That Need Foster Homes</h1>
        <p class="subtitle">The solution for those of you who want to keep animals for a short time.</p>
    </div>

    <div class="animals-grid">
        @if(isset($fosterAnimals) && count($fosterAnimals) > 0)
            @foreach($fosterAnimals as $animal)
            <div class="animal-card">
                <a href="{{ route('foster.form', ['id' => $animal['id']]) }}" class="block relative w-full h-full">
                    <div class="animal-image">
                        <img src="{{ asset($animal['image']) }}" alt="{{ $animal['name'] }}">
                    </div>
                    <div class="animal-overlay">
                        <h3 class="animal-name">{{ $animal['name'] }}</h3>
                        <p class="animal-breed">{{ $animal['breed'] }}</p>
                        <div class="animal-details">
                            <div class="detail-item">
                                <span class="icon">⏰</span>
                                <span>{{ $animal['age'] }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="icon">🎨</span>
                                <span>{{ $animal['color'] }}</span>
                            </div>
                        </div>
                        <div class="animal-status">
                            <span class="status-text">Condition: Healthy</span>
                        </div>
                        <div class="foster-action">
                            <span class="foster-text">Foster Now</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @else
            <div class="animal-card" onclick="window.location.href='{{ route('foster.form', ['id' => 1]) }}'">
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.container.mx-auto {
    max-width: none !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
}

.relative.bg-gray-900 {
    display: none !important;
}

body {
    background-color: #f8f9fa;
    font-family: 'Inter', sans-serif;
}

.foster-needs-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.header-section {
    text-align: left;
    margin-bottom: 40px;
}

.main-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
    line-height: 1.2;
}

.subtitle {
    font-size: 1rem;
    color: #666;
    max-width: 600px;
    line-height: 1.5;
}

.animals-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.animal-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 300px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.animal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.animal-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.animal-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.animal-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    color: white;
    padding: 20px 15px 15px;
    z-index: 2;
}

.animal-name {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: white;
}

.animal-breed {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 10px 0;
}

.animal-details {
    display: flex;
    gap: 15px;
    margin-bottom: 8px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.9);
}

.detail-item .icon {
    font-size: 0.7rem;
}

.animal-status {
    margin-bottom: 8px;
}

.status-text {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.9);
}

.foster-action {
    margin-top: 5px;
}

.foster-text {
    font-size: 0.8rem;
    color: #FFD700;
    font-weight: 500;
}

@media (max-width: 1024px) {
    .animals-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .main-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .foster-needs-container {
        padding: 20px 15px;
    }
    
    .animals-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .main-title {
        font-size: 1.8rem;
    }
    
    .animal-card {
        height: 250px;
    }
}

@media (max-width: 480px) {
    .main-title {
        font-size: 1.5rem;
    }
    
    .animal-card {
        height: 220px;
    }
    
    .animal-overlay {
        padding: 15px 12px 12px;
    }
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

.animal-card {
    animation: fadeInUp 0.6s ease-out;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.animal-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
@endpush

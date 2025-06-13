@extends('layouts.app')

@section('content')
<div class="foster-landing-container">
    <div class="foster-info-section">
        <div onclick="goToFosterInfo()" style="cursor: pointer;" class="info-header">
            <h2 class="section-title">Foster Home Info</h2>
            <p class="section-subtitle">Search for the Animal Category You Want to Lovely</p>
        </div>
    </div>

    <div class="animals-section">
        <div class="section-header">
            <div>
                <h2 class="section-title">Animals That Need Foster Homes</h2>
                <p class="section-subtitle">Foster Home is quickly becoming the preferred way to find a new dog, puppy, cat, kitten or etc.</p>
            </div>
            <a href="{{ route('foster.needs') }}" >View All</a>
        </div>

        <div class="pet-cards-grid" id="pet-grid">
            @if(isset($fosterAnimals) && count($fosterAnimals) > 0)
                @foreach($fosterAnimals->take(3) as $animal)
                <div class="pet-card" onclick="showPetDetails({{ $animal['id'] }})">
                    <div class="pet-image">
                        <img src="{{ asset($animal['image']) }}" alt="{{ $animal['name'] }}" />
                    </div>
                    <div class="pet-overlay">
                        <h3 class="pet-name">{{ $animal['name'] }}</h3>
                        <p class="pet-breed">{{ $animal['breed'] }}</p>
                        <div class="pet-details">
                            <span class="pet-age">
                                <i class="fas fa-clock"></i> {{ $animal['age'] }}
                            </span>
                            <span class="pet-gender">
                                <i class="fas fa-heart"></i> {{ $animal['gender'] }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="pet-card" onclick="showPetDetails(1)">
                    <div class="pet-image">
                        <img src="{{ asset('image/kucing.jpg') }}" alt="Daisy" />
                    </div>
                    <div class="pet-overlay">
                        <h3 class="pet-name">Daisy</h3>
                        <p class="pet-breed">Mix Dom Anggora</p>
                        <div class="pet-details">
                            <span class="pet-age">
                                <i class="fas fa-clock"></i> 1 Year
                            </span>
                            <span class="pet-gender">
                                <i class="fas fa-heart"></i> White Lilac
                            </span>
                        </div>
                    </div>
                </div>

                <div class="pet-card" onclick="showPetDetails(2)">
                    <div class="pet-image">
                        <img src="{{ asset('image/kucing1.jpg') }}" alt="Daisy" />
                    </div>
                    <div class="pet-overlay">
                        <h3 class="pet-name">Chiara</h3>
                        <p class="pet-breed">Siberian Cat</p>
                        <div class="pet-details">
                            <span class="pet-age">
                                <i class="fas fa-clock"></i> 2 Year
                            </span>
                            <span class="pet-gender">
                                <i class="fas fa-heart"></i> Grey & White
                            </span>
                        </div>
                    </div>
                </div>

                <div class="pet-card" onclick="showPetDetails(3)">
                    <div class="pet-image">
                        <img src="{{ asset('image/anjing.png') }}" alt="Daisy" />
                    </div>
                    <div class="pet-overlay">
                        <h3 class="pet-name">Cocoa</h3>
                        <p class="pet-breed">Pomeranian</p>
                        <div class="pet-details">
                            <span class="pet-age">
                                <i class="fas fa-clock"></i> 1 Year
                            </span>
                            <span class="pet-gender">
                                <i class="fas fa-heart"></i> Golden Brown
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="progress-section">
        <div class="section-header">
            <div>
                <h2 class="section-title">Progress Report</h2>
                <p class="section-subtitle">My Animal Development</p>
            </div>
            <a href="javascript:void(0)"  onclick="renderProgressSample()" style="color: #facc15;">View All</a>

        </div>

        <div class="progress-report-container hidden" id="progress-report">
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
.foster-landing-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: 'Poppins', sans-serif;
}

.foster-info-section {
    margin-bottom: 60px;
}

.info-header {
    transition: transform 0.3s ease;
}

.info-header:hover {
    transform: translateY(-2px);
}

.animals-section {
    margin-bottom: 60px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
}

.section-title {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 10px;
    line-height: 1.2;
}

.section-subtitle {
    font-size: 1rem;
    color: #666;
    margin: 0;
    max-width: 600px;
    line-height: 1.5;
}

.view-all-btn {
    background: transparent;
    border: 2px solid #333;
    color: #333;
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.view-all-btn:hover {
    background: #333;
    color: white;
    text-decoration: none;
}

.pet-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.pet-card {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 400px;
    background: #f5f5f5;
}

.pet-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.pet-image {
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.pet-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.pet-card:hover .pet-image img {
    transform: scale(1.05);
}

.pet-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    color: white;
    padding: 30px 20px 20px;
}

.pet-name {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 5px 0;
    color: white;
}

.pet-breed {
    font-size: 1rem;
    margin: 0 0 15px 0;
    color: rgba(255, 255, 255, 0.9);
}

.pet-details {
    display: flex;
    gap: 20px;
    font-size: 0.9rem;
}

.pet-age,
.pet-gender {
    display: flex;
    align-items: center;
    gap: 5px;
    color: rgba(255, 255, 255, 0.9);
}

.pet-age i,
.pet-gender i {
    font-size: 0.8rem;
}

.progress-section {
    margin-bottom: 60px;
}

.progress-report-container {
    margin-top: 30px;
}

.progress-report-container.hidden {
    display: none;
}

.progress-card {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.progress-card:hover {
    transform: translateY(-5px);
}

.progress-image {
    width: 100%;
    height: 200px;
    background-size: cover;
    background-position: center;
    border-radius: 10px;
    margin-bottom: 15px;
}

.progress-info h3 {
    margin: 0 0 10px 0;
    color: #333;
    font-weight: 600;
}

.progress-info p {
    margin: 5px 0;
    color: #666;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .foster-landing-container {
        padding: 20px 15px;
    }
    
    .section-header {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .pet-cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .pet-card {
        height: 350px;
    }
    
    .view-all-btn {
        width: 100%;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 1.8rem;
    }
    
    .pet-details {
        flex-direction: column;
        gap: 8px;
    }
}

.section-header a { 
    color: #facc15;
}
</style>
@endpush

@push('scripts')
<script>
function goToFosterInfo() {
    try {
        window.location.href = "{{ route('foster.info') }}";
    } catch (error) {
        console.error('Error navigating to foster info:', error);
        window.location.href = '/foster/info';
    }
}

function showPetDetails(petId) {
    try {
        // PERBAIKAN: Gunakan route foster.form bukan fosterHome.form
        window.location.href = "{{ route('foster.form', ['id' => ':id']) }}".replace(':id', petId);
    } catch (error) {
        console.error('Error navigating to pet details:', error);
        window.location.href = `/foster/form/${petId}`;
    }
}

function renderProgressSample() {
    const container = document.getElementById('progress-report');
    container.classList.remove('hidden');
    
    container.innerHTML = `
        <div class="progress-card" onclick="goToProgressReport('Daisy')" style="cursor: pointer;">
            <div class="progress-image" style="background-image: url('{{ asset('image/kucing.jpg') }}'); height: 120px; width: 120px;"></div>
            <div class="progress-info">
                <h3>Daisy</h3>
                <p><strong>Breed:</strong> Mix Dom Anggora</p>
                <p><strong>Age:</strong> 1 Year</p>
                <p><strong>Status:</strong> Ready for Coming to your home</p>
                <p><strong>Progress:</strong> Found → Cared for → Ready to be a Friend</p>
            </div>
        </div>
    `;
}

function goToProgressReport(petName) {
    window.location.href = `/foster/report?pet=${encodeURIComponent(petName)}`;
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    console.log('Foster Landing page loaded');
});
</script>
@endpush

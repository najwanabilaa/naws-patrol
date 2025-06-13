@extends('layouts.app')

@section('content')
<div class="help-page">
    <div class="help-header">
        <a href="{{ route('adopt.index') }}" class="back-link">&lt; Back</a>
        <h1>Help Me Find a Home</h1>
        <p class="help-description">These animals are looking for loving families to give them a second chance at happiness. Every adoption saves a life and makes room for another animal in need.</p>
    </div>

    <div class="filter-section">
        <div class="filter-container">
            <div class="filter-group">
                <label for="typeFilter">Type:</label>
                <select id="typeFilter" onchange="filterAnimals()">
                    <option value="">All Animals</option>
                    <option value="cats">Cats</option>
                    <option value="dogs">Dogs</option>
                    <option value="birds">Birds</option>
                    <option value="rabbits">Rabbits</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="ageFilter">Age:</label>
                <select id="ageFilter" onchange="filterAnimals()">
                    <option value="">All Ages</option>
                    <option value="young">Young (0-2 years)</option>
                    <option value="adult">Adult (2-7 years)</option>
                    <option value="senior">Senior (7+ years)</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="genderFilter">Gender:</label>
                <select id="genderFilter" onchange="filterAnimals()">
                    <option value="">All Genders</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="search-group">
                <input type="text" id="searchFilter" placeholder="Search by name or breed..." onkeyup="filterAnimals()">
                <button onclick="clearFilters()" class="clear-btn">Clear All</button>
            </div>
        </div>
    </div>

    <div class="animals-grid" id="animalsGrid">
        @forelse($helpPets as $pet)
        <div class="animal-card" 
             data-type="{{ $pet['category'] }}" 
             data-age="{{ $pet['age'] }}" 
             data-gender="{{ $pet['gender'] }}" 
             data-name="{{ strtolower($pet['name']) }}" 
             data-breed="{{ strtolower($pet['breed']) }}">
            <div class="animal-image">
                <img src="{{ asset($pet['image']) }}" alt="{{ $pet['name'] }}" />
                <div class="urgent-badge">
                    <span>🏠 Needs Home</span>
                </div>
                <div class="animal-overlay">
                    <button class="adopt-btn" onclick="adoptAnimal({{ $pet['id'] }})">
                        Adopt Me
                    </button>
                </div>
            </div>
            <div class="animal-info">
                <h3>{{ $pet['name'] }}</h3>
                <p class="breed">{{ $pet['breed'] }}</p>
                <div class="animal-details">
                    <span class="age">{{ $pet['age'] }}</span>
                    <span class="gender">{{ $pet['gender'] }}</span>
                    <span class="location">📍 {{ $pet['location'] }}</span>
                </div>
                <p class="description">{{ Str::limit($pet['description'], 80) }}</p>
                <div class="action-buttons">
                    <button class="btn-detail" onclick="viewDetail({{ $pet['id'] }})">
                        View Details
                    </button>
                    <button class="btn-favorite" onclick="toggleFavorite({{ $pet['id'] }})">
                        ❤️
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="no-animals">
            <h3>No animals available at the moment</h3>
            <p>Please check back later or contact us for more information.</p>
        </div>
        @endforelse
    </div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
.help-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
}

.help-header {
    text-align: center;
    margin-bottom: 40px;
}

.back-link {
    display: inline-block;
    margin-bottom: 20px;
    color: #666;
    text-decoration: none;
    font-weight: 600;
}

.back-link:hover {
    color: #333;
}

.help-header h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 15px;
    font-weight: 700;
}

.help-description {
    font-size: 1.1rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.filter-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 30px;
}

.filter-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.filter-group select,
.search-group input {
    padding: 10px 15px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s;
}

.filter-group select:focus,
.search-group input:focus {
    outline: none;
    border-color: #007bff;
}

.search-group {
    display: flex;
    gap: 10px;
    align-items: end;
}

.search-group input {
    flex: 1;
}

.clear-btn {
    padding: 10px 20px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
}

.clear-btn:hover {
    background: #c82333;
}

.animals-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.animal-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.animal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.animal-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.animal-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.animal-card:hover .animal-image img {
    transform: scale(1.05);
}

.urgent-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    box-shadow: 0 2px 10px rgba(255, 107, 107, 0.3);
}

.animal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.animal-card:hover .animal-overlay {
    opacity: 1;
}

.adopt-btn {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transform: translateY(10px);
    transition: transform 0.3s;
}

.animal-card:hover .adopt-btn {
    transform: translateY(0);
}

.animal-info {
    padding: 20px;
}

.animal-info h3 {
    font-size: 1.4rem;
    color: #333;
    margin-bottom: 5px;
    font-weight: 600;
}

.breed {
    color: #007bff;
    font-weight: 500;
    margin-bottom: 10px;
}

.animal-details {
    display: flex;
    gap: 15px;
    margin-bottom: 12px;
    font-size: 14px;
    color: #666;
}

.description {
    color: #666;
    line-height: 1.5;
    margin-bottom: 15px;
    font-size: 14px;
}

.action-buttons {
    display: flex;
    gap: 10px;
}

.btn-detail {
    flex: 1;
    padding: 10px;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-detail:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.btn-favorite {
    padding: 10px 15px;
    background: #fff;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-favorite:hover {
    background: #ff6b6b;
    border-color: #ff6b6b;
    transform: scale(1.1);
}

.stats-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px;
    border-radius: 15px;
    margin-bottom: 40px;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 30px;
    text-align: center;
}

.stat-item h3 {
    font-size: 2.5rem;
    margin-bottom: 5px;
    font-weight: 700;
}

.stat-item p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.cta-section {
    text-align: center;
    padding: 40px 20px;
}

.cta-section h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 15px;
}

.cta-section p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 30px;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary,
.btn-secondary {
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    color: white;
    text-decoration: none;
}

.btn-secondary {
    background: white;
    color: #007bff;
    border: 2px solid #007bff;
}

.btn-secondary:hover {
    background: #007bff;
    color: white;
    text-decoration: none;
}

.no-animals {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.hidden {
    display: none !important;
}

@media (max-width: 768px) {
    .help-header h1 {
        font-size: 2rem;
    }
    
    .filter-container {
        grid-template-columns: 1fr;
    }
    
    .animals-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-primary,
    .btn-secondary {
        width: 100%;
        max-width: 300px;
    }
}
</style>
@endpush

@push('scripts')
<script>
function filterAnimals() {
    const typeFilter = document.getElementById('typeFilter').value;
    const ageFilter = document.getElementById('ageFilter').value;
    const genderFilter = document.getElementById('genderFilter').value;
    const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
    
    const cards = document.querySelectorAll('.animal-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const type = card.getAttribute('data-type');
        const age = card.getAttribute('data-age');
        const gender = card.getAttribute('data-gender');
        const name = card.getAttribute('data-name');
        const breed = card.getAttribute('data-breed');
        
        let showCard = true;
        
        if (typeFilter && type !== typeFilter) {
            showCard = false;
        }
        
        if (ageFilter && showCard) {
            const ageNum = parseInt(age);
            if (ageFilter === 'young' && ageNum > 2) showCard = false;
            if (ageFilter === 'adult' && (ageNum <= 2 || ageNum > 7)) showCard = false;
            if (ageFilter === 'senior' && ageNum <= 7) showCard = false;
        }
        
        if (genderFilter && gender !== genderFilter) {
            showCard = false;
        }
    
        if (searchFilter && showCard) {
            if (!name.includes(searchFilter) && !breed.includes(searchFilter)) {
                showCard = false;
            }
        }
        
        if (showCard) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    const grid = document.getElementById('animalsGrid');
    let noResultsMsg = document.getElementById('noResultsMessage');
    
    if (visibleCount === 0) {
        if (!noResultsMsg) {
            noResultsMsg = document.createElement('div');
            noResultsMsg.id = 'noResultsMessage';
            noResultsMsg.className = 'no-animals';
            noResultsMsg.innerHTML = '<h3>No animals match your criteria</h3><p>Try adjusting your filters or search terms.</p>';
            grid.appendChild(noResultsMsg);
        }
        noResultsMsg.style.display = 'block';
    } else if (noResultsMsg) {
        noResultsMsg.style.display = 'none';
    }
}

function clearFilters() {
    document.getElementById('typeFilter').value = '';
    document.getElementById('ageFilter').value = '';
    document.getElementById('genderFilter').value = '';
    document.getElementById('searchFilter').value = '';
    filterAnimals();
}

function adoptAnimal(petId) {
    window.location.href = `/adopt/form?pet_id=${petId}`;
}

function viewDetail(petId) {
    window.location.href = `/adopt/detail/${petId}`;
}

function toggleFavorite(petId) {
    const btn = event.target;
    btn.style.transform = 'scale(1.2)';
    setTimeout(() => {
        btn.style.transform = 'scale(1)';
    }, 200);
    console.log('Added to favorites:', petId);
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchFilter');
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            filterAnimals();
        }
    });
});
</script>
@endpush

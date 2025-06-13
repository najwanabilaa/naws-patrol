@extends('layouts.app')

@section('content')
<section class="adoption-category">
    <div class="container">
        <h2>Adoption Category</h2>
        <p>Search for the Animal Category You Want to Adopt</p>
    </div>
    <div class="category-container">
        <div class="category cats" onclick="goToPage('cats')">
            <span>Cats</span>
            <div class="category-icon">
                <img src="{{ asset('image/cat.png') }}" alt="Cats" />
            </div>
        </div>
        <div class="category dogs" onclick="goToPage('dogs')">
            <span>Dogs</span>
            <img src="{{ asset('image/dog.png') }}" alt="Dogs" />
        </div>
        <div class="category birds" onclick="goToPage('birds')">
            <span>Birds</span>
            <img src="{{ asset('image/bird.png') }}" alt="Birds" />
        </div>
        <div class="category rabbits" onclick="goToPage('rabbits')">
            <span>Rabbits</span>
            <img src="{{ asset('image/rabbit.png') }}" alt="Rabbits" />
        </div>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search..." />
            <button onclick="searchCategory()">
                <img src="{{ asset('image/search.png') }}" alt="Search" />
            </button>
        </div>
    </div>
</section>

<section id="category-results" style="display: none;">
    <div class="container">
        <h3 id="category-title"></h3>
        <p id="category-subtitle"></p>
        <div id="category-pets" class="pet-cards"></div>
        <div id="pagination-controls"></div>
    </div>
</section>

<section id="default-pets" class="adoption-section">
    <div class="section-header">
        <h2>Adoption Status</h2>
        <a href="{{ route('adopt.status') }}">View All</a>
    </div>
    <p class="section-description">Pet adoption is quickly becoming the preferred way to find a new dog, puppy, cat,
        kitten or etc.</p>

    <div class="section-header">
        <h2>Help Me Find a Home</h2>
        <a href="{{ route('adopt.help') }}">View All</a>
    </div>
    <p class="section-description">Pet adoption is quickly becoming the preferred way to find a new dog, puppy, cat,
        kitten or etc.</p>
   
</section>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/adopt/adopt.css') }}">
@endpush

@push('scripts')
<script>
let currentPage = 1;
let currentCategory = '';
let itemsPerPage = 6;

document.addEventListener('DOMContentLoaded', function() {
    loadDefaultPets();
});

function goToPage(category) {
    currentCategory = category;
    currentPage = 1;
    
    document.getElementById('default-pets').style.display = 'none';
    document.getElementById('category-results').style.display = 'block';
    
    const categoryTitle = document.getElementById('category-title');
    const categorySubtitle = document.getElementById('category-subtitle');
    
    categoryTitle.textContent = `Result for "${category.charAt(0).toUpperCase() + category.slice(1)}"`;
    
    loadPetsByCategory(category);
}

function loadPetsByCategory(category) {
    const petsContainer = document.getElementById('category-pets');
    petsContainer.innerHTML = '<div class="loading">Loading...</div>';
    
    fetch(`/api/pets?category=${category}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayPets(data.data, category);
                updateSubtitle(data.data.length, category);
                setupPagination(data.data.length);
            } else {
                petsContainer.innerHTML = '<div class="no-results">No pets found in this category.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            petsContainer.innerHTML = '<div class="error">Error loading pets. Please try again.</div>';
        });
}

function searchCategory() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.trim();
    
    if (searchTerm === '') {
        alert('Please enter a search term');
        return;
    }
    
    document.getElementById('default-pets').style.display = 'none';
    document.getElementById('category-results').style.display = 'block';
    
    const categoryTitle = document.getElementById('category-title');
    const categorySubtitle = document.getElementById('category-subtitle');
    
    categoryTitle.textContent = `Search Results for "${searchTerm}"`;

    const petsContainer = document.getElementById('category-pets');
    petsContainer.innerHTML = '<div class="loading">Searching...</div>';
    
    fetch(`/api/pets?search=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayPets(data.data, 'search');
                updateSubtitle(data.data.length, 'search', searchTerm);
                setupPagination(data.data.length);
            } else {
                petsContainer.innerHTML = '<div class="no-results">No pets found matching your search.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            petsContainer.innerHTML = '<div class="error">Error searching pets. Please try again.</div>';
        });
}

function displayPets(pets, type) {
    const petsContainer = document.getElementById('category-pets');
    
    if (pets.length === 0) {
        petsContainer.innerHTML = '<div class="no-results">No pets available.</div>';
        return;
    }
    
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const petsToShow = pets.slice(startIndex, endIndex);
    
    let html = '';
    petsToShow.forEach(pet => {
        html += `
            <div class="pet-card" onclick="viewPetDetail(${pet.id})">
                <div class="pet-image">
                    <img src="${pet.image}" alt="${pet.name}" />
                    <div class="pet-overlay">
                        <span class="pet-name">${pet.name}</span>
                        <div class="pet-info">
                            <span class="pet-age">${pet.age}</span>
                            <span class="pet-gender">${pet.gender}</span>
                        </div>
                    </div>
                </div>
                <div class="pet-details">
                    <h4>${pet.name}</h4>
                    <p>${pet.breed}</p>
                    <span class="pet-location">📍 ${pet.location}</span>
                </div>
            </div>
        `;
    });
    
    petsContainer.innerHTML = html;
}

function updateSubtitle(totalPets, type, searchTerm = '') {
    const categorySubtitle = document.getElementById('category-subtitle');
    
    if (type === 'search') {
        categorySubtitle.textContent = `${totalPets} pets found for "${searchTerm}"`;
    } else {
        categorySubtitle.textContent = `${totalPets} ${type} available for adoption`;
    }
}

function setupPagination(totalItems) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const paginationContainer = document.getElementById('pagination-controls');
    
    if (totalPages <= 1) {
        paginationContainer.innerHTML = '';
        return;
    }
    
    let paginationHtml = '<div class="pagination">';
    
    if (currentPage > 1) {
        paginationHtml += `<button class="page-btn" onclick="changePage(${currentPage - 1})">← Prev</button>`;
    }
    
    for (let i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
            paginationHtml += `<button class="page-btn active">${i}</button>`;
        } else {
            paginationHtml += `<button class="page-btn" onclick="changePage(${i})">${i}</button>`;
        }
    }
    
    if (currentPage < totalPages) {
        paginationHtml += `<button class="page-btn" onclick="changePage(${currentPage + 1})">Next →</button>`;
    }
    
    paginationHtml += '</div>';
    paginationContainer.innerHTML = paginationHtml;
}

function changePage(page) {
    currentPage = page;
    
    if (currentCategory) {
        loadPetsByCategory(currentCategory);
    } else {
        const searchInput = document.getElementById('searchInput');
        if (searchInput.value.trim()) {
            searchCategory();
        }
    }
}

function viewPetDetail(petId) {
    window.location.href = `/adopt/detail/${petId}`;
}

function loadDefaultPets() {
    fetch('/api/pets')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayDefaultPets(data.data.slice(0, 6)); 
            }
        })
        .catch(error => {
            console.error('Error loading default pets:', error);
        });
}

function displayDefaultPets(pets) {
    const defaultContainer = document.getElementById('default-pet-cards');
    
    let html = '';
    pets.forEach(pet => {
        html += `
            <div class="pet-card" onclick="viewPetDetail(${pet.id})">
                <div class="pet-image">
                    <img src="${pet.image}" alt="${pet.name}" />
                    <div class="pet-overlay">
                        <span class="pet-name">${pet.name}</span>
                    </div>
                </div>
                <div class="pet-details">
                    <h4>${pet.name}</h4>
                    <p>${pet.breed} • ${pet.age}</p>
                    <span class="pet-location">📍 ${pet.location}</span>
                </div>
            </div>
        `;
    });
    
    defaultContainer.innerHTML = html;
}

function backToHome() {
    document.getElementById('default-pets').style.display = 'block';
    document.getElementById('category-results').style.display = 'none';
    currentCategory = '';
    currentPage = 1;
    document.getElementById('searchInput').value = '';
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchCategory();
        }
    });
});
</script>
@endpush

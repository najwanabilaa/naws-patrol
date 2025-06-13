@extends('layouts.app')

@section('content')
<div class="adopt-status-page">
    <a href="{{ route('adopt.index') }}" class="back-link">&lt; Back</a>
    <h2>Adoption Status</h2>
    
    <div class="alert">
        <span>!</span>
        <p>The data below are animals that will be adopted by you if verification from the shelter is appropriate and
            you can be trusted, be a good friend to them</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Number</th>
                <th>Animal Name</th>
                <th>Application Date</th>
                <th>Application Status</th>
                <th>Approval Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($adoptions) && count($adoptions) > 0)
                @foreach($adoptions as $index => $adoption)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $adoption->pet_name }}</td>
                    <td>{{ $adoption->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($adoption->status === 'pending')
                            Processing
                        @elseif($adoption->status === 'approved')
                            Approved
                        @elseif($adoption->status === 'rejected')
                            Rejected
                        @else
                            Unknown Status
                        @endif
                    </td>
                    <td>{{ $adoption->approved_at ? $adoption->approved_at->format('Y-m-d') : '-' }}</td>
                    <td><button onclick="lihatDetail({{ $adoption->id }})">View</button></td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                        No adoption applications yet
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    
    <div class="search-section">
        <h1>List of animals you adopted</h1>
        <input type="text" id="searchInput" placeholder="Search animal name" onkeyup="searchAdoptedPets()" />
    </div>
    
    <div class="card-container" id="adoptedPetsContainer">
        @if(isset($adoptions) && count($adoptions) > 0)
            @php
                $approvedAdoptions = collect($adoptions)->where('status', 'approved');
            @endphp
            
            @if(count($approvedAdoptions) > 0)
                @foreach($approvedAdoptions as $adoption)
                <div class="card" data-pet-name="{{ strtolower($adoption->pet_name) }}">
                    <div class="card-image-wrapper">
                        <img src="{{ asset($adoption->pet_image ? $adoption->pet_image : 'image/anjing.png') }}" alt="{{ $adoption->pet_name }}" />
                        <div class="overlay-text">{{ $adoption->pet_name }}</div>
                        <span class="tag-icon">🐾</span>
                        <button class="btn-detail" onclick="lihatDetail({{ $adoption->id }})">View More Details</button>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-data-message">
                    <p style="text-align: center; color: #666; margin-top: 40px; font-size: 16px;">
                        No animals approved for adoption yet
                    </p>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="{{ route('adopt.index') }}" class="btn-adopt-now">
                            Start Adopting Now
                        </a>
                    </div>
                </div>
            @endif
        @else
            <div class="no-data-message">
                <p style="text-align: center; color: #666; margin-top: 40px; font-size: 16px;">
                    You haven't applied for any animal adoption yet
                </p>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('adopt.index') }}" class="btn-adopt-now">
                        Start Adopting Now
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function lihatDetail(adoptionId) {
    window.location.href = '/adopt/detail/' + adoptionId;
}

function searchAdoptedPets() {
    var searchInput = document.getElementById('searchInput');
    var searchTerm = searchInput.value.toLowerCase();
    var cards = document.querySelectorAll('.card');
    var visibleCount = 0;
    
    for (var i = 0; i < cards.length; i++) {
        var card = cards[i];
        var petName = card.getAttribute('data-pet-name');
        if (petName && petName.indexOf(searchTerm) !== -1) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    }
    
    var container = document.getElementById('adoptedPetsContainer');
    var noResultsMsg = document.getElementById('noResultsMessage');
    
    if (visibleCount === 0 && searchTerm !== '' && cards.length > 0) {
        if (!noResultsMsg) {
            noResultsMsg = document.createElement('div');
            noResultsMsg.id = 'noResultsMessage';
            noResultsMsg.innerHTML = '<p style="text-align: center; color: #666; margin-top: 20px;">No animals found with the name "' + searchInput.value + '"</p>';
            container.appendChild(noResultsMsg);
        }
        noResultsMsg.style.display = 'block';
    } else if (noResultsMsg) {
        noResultsMsg.style.display = 'none';
    }
}
</script>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/adopt/adoptStatus.css') }}" />
<style>
.no-data-message {
    text-align: center;
    padding: 40px 20px;
}

.btn-adopt-now {
    display: inline-block;
    background: #007bff;
    color: white;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: background-color 0.3s;
}

.btn-adopt-now:hover {
    background: #0056b3;
    color: white;
    text-decoration: none;
}

#searchInput {
    width: 100%;
    max-width: 400px;
    padding: 10px 15px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    margin-top: 10px;
}

#searchInput:focus {
    outline: none;
    border-color: #007bff;
}

.card {
    transition: opacity 0.3s ease;
}

@media (max-width: 768px) {
    table {
        font-size: 12px;
    }
    
    .card-container {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

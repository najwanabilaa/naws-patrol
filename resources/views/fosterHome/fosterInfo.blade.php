@extends('layouts.app')

@section('content')
<div class="mb-6">
        <a href="{{ route('foster.landing') }}" class="text-yellow-400 hover:text-yellow-500">← Go Back</a>
    </div>

<main class="profile-container">
<section class="user-info">
    <div class="info-item">
        <img src="{{ asset('image/person.svg') }}" alt="User Icon" />
        <div>
            <strong>Name</strong><br />
            <span id="user-name">{{ $fosterData['name'] ?? 'Rumahsinggahkelompok4' }}</span>
        </div>
    </div>
    <div class="info-item">
        <img src="{{ asset('image/Calendar.svg') }}" alt="User Icon" />
        <div>
            <strong>Joined Since</strong><br />
            <span id="user-name">{{ $fosterData['joined_date'] ?? '20 May 2024' }}</span>
        </div>
    </div>
    <div class="info-item">
        <img src="{{ asset('image/time.svg') }}" alt="User Icon" />
        <div>
            <strong>Active Duration</strong><br />
            <span id="user-name">{{ $fosterData['duration_active'] ?? '1 Year 2 Months' }}</span>
        </div>
    </div>
    <div class="info-item">
        <img src="{{ asset('image/foster-cat-hand.png') }}" alt="User Icon" />
        <div>
            <strong>Animal Types That Can Be Fostered</strong><br />
            <span id="user-name">{{ $fosterData['animal_types'] ?? 'Cats, dogs' }}</span>
        </div>
    </div>
</section>
</main>

<script>
function goBack() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/foster-home'; 
        alert('No previous page to go back to');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const infoItems = document.querySelectorAll('.info-item');
    
    infoItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 150);
    });
});
</script>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
<style>
.container.mx-auto {
    max-width: none !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
}

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #f5f5f5;
}

.header {
    background-color: #1B2B44;
    padding: 0;
    position: relative;
    overflow: hidden;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
    min-height: 400px;
    background-image: url('/image/paw.png');
    background-repeat: no-repeat;
    background-position: center bottom -800px;
    background-size: 1350px;
    opacity: 0.9;
}

.header h1 {
    color: white;
    margin-top: 100px;
    margin-left: 50px;
}

.paw-print {
    display: none; 
}

.header p {
    color: white;
    margin-top: 70px;
    margin-left: 50px;
}   

.nav-menu {
    display: flex;
    padding: 16px 32px;
    gap: 32px;
    background-color: transparent;
    position: relative;
    z-index: 3;
    justify-content: center;
}

.nav-menu a {
    color: white;
    text-decoration: none;
    font-size: 14px;
    opacity: 0.7;
    transition: opacity 0.3s;
    font-weight: 500;
}

.nav-menu a.active {
    opacity: 1;
}

.nav-menu a:hover {
    opacity: 1;
} 

.profile-container {
    width: 600px;
    height: 370px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding-top: -400px;
    font-family: 'Poppins', sans-serif;
    padding: 20px;
    margin: auto;
    border-radius: 5%;
}

.profile-picture-container {
    position: absolute;
    top: 240px;
    right: 130px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    border: none;
    background-color: #ccc;
}

.profile-picture-container img.profile-picture {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding-top: 30px;
}

.title {
    font-size: 3rem;
    font-weight: bold;
    margin: 20px 0 10px;
    text-align: left;
}

.description {
    font-size: 14px;
    color: #ffffff;
    text-align: left;
    max-width: 500px;
}

.user-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-left: 80px;
    margin-top: 5px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 5rem;
    font-size: 1rem;
}

.info-item img {
    width: 32px;
    height: 32px;
    align-items: center;
}

.report-title {
    text-align: center;
    font-weight: bold;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.report-cards {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: nowrap;
}

.card {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    border: 1px solid #000000;
    border-radius: 12px;
    padding: 1rem;
    background-color: #fff;
    min-width: 0; 
    box-sizing: border-box;
}

.card img {
    width: 40px;
    height: 40px;
}

.card.yellow {
    background-color: #ffffff;
    border: 1px solid #000000;
}

.button-row {
    display: flex;
    justify-content: space-between;
}

.settings-btn {
    background-color: #FAAF32;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 20px;
    font-weight: bold;
    cursor: pointer;
    color: #ffffff;
}

.logout-btn {
    background-color: #FF0000;
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 20px;
    font-weight: bold;
    cursor: pointer;
}

.icon-box {
    background-color: #FAAF32; 
    padding: 10px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-box img {
    width: 40px;
    height: 40px;
}

.settings-btn,
.logout-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: bold;
}

.btn-icon.right {
    width: 20px;
    height: 20px;
    margin-left: 8px;
    vertical-align: middle;
}
</style>
@endpush

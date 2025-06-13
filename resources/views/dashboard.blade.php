@extends('layouts.app')

@section('content')
<div class="dashboard-content">
  <div class="dashboard-container">
    <div class="about-section">
      <p class="about-title">
        <span class="highlight">About Naw's Patrol</span>
      </p>
      <p class="about-description">
        Naw's Patrol adalah platform digital untuk melaporkan hewan liar, mengadopsi hewan terlantar, dan menjadi
        rumah sementara (foster). Kami hadir untuk menyelamatkan, merawat, dan menghubungkan hewan-hewan yang
        membutuhkan dengan orang-orang penuh kepedulian.
      </p>
      <p class="about-mission">
        Naw's Patrol membantu hewan menemukan harapan baru. Bersama, kita bisa menciptakan dunia yang lebih ramah
        dan peduli.
      </p>
    </div>

    <img class="hero-image" src="{{ asset('image/group 28.png') }}" alt="Hero Image" />
    

    <div class="services-section">
      <div class="services-header">
        <p class="welcome-title">
          <span class="welcome-text">Welcome to Naw's Patrol!</span>
        </p>
        <p class="welcome-subtitle">
          We're dedicated to rescuing, protecting, and connecting animals in need with loving homes — through
          reports, adoption, and foster care.
        </p>
      </div>
      
      <div class="services-grid">
        <div class="service-card" onclick="window.location.href='{{ route('adopt.index') }}'">
          <div class="card-background"></div>
          <img class="service-icon" src="{{ asset('image/icons8-adoption-64 2.png') }}" alt="Adoption" />
          <div class="card-content">
            <p class="service-title">Adopsi</p>
            <p class="service-description">
              Menghubungkan hewan terlantar dengan rumah baru yang penuh kasih dan tanggung jawab.
            </p>
          </div>
        </div>

        <div class="service-card" onclick="window.location.href='{{ route('fosterHome.form') }}'">
          <div class="card-background"></div>
          <img class="service-icon" src="{{ asset('image/icons8-home-50 1.png') }}" alt="Foster Home" />
          <div class="card-content">
            <p class="service-title">Foster Home</p>
            <p class="service-description">
              Kami berkomitmen menyediakan rumah sementara yang aman dan nyaman untuk hewan terlantar selama masa
              perawatan.
            </p>
          </div>
        </div>

        <div class="service-card" onclick="window.location.href='#'">
          <div class="card-background"></div>
          <img class="service-icon" src="{{ asset('image/icons8-briefcase-50 1.png') }}" alt="Report" />
          <div class="card-content">
            <p class="service-title">Laporan Hewan</p>
            <p class="service-description">
              Memudahkan pelaporan hewan terlantar atau butuh bantuan agar segera mendapatkan pertolongan.
            </p>
          </div>
        </div>

        <div class="service-card" onclick="window.location.href='{{ route('donations.index') }}'">
          <div class="card-background"></div>
          <img class="service-icon" src="{{ asset('image/icons8-donation-64 1.png') }}" alt="Donation" />
          <div class="card-content">
            <p class="service-title">Donasi</p>
            <p class="service-description">
              Mendukung kebutuhan hewan terlantar seperti makanan, perawatan, dan tempat tinggal
            </p>
          </div>
        </div>
        <div class="service-card" onclick="window.location.href='#'">
          <div class="card-background"></div>
          <img class="service-icon" src="{{ asset('image/icons8-article-50 1.png') }}" alt="Education" />
          <div class="card-content">
            <p class="service-title">Edukasi</p>
            <p class="service-description">
              Memberikan informasi dan tips penting untuk merawat dan melindungi hewan dengan baik.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="dashboard-footer">
  <div class="footer-content">
    <div class="footer-section">
      <img class="footer-icon" src="{{ asset('image/icons8-cat-50 1.png') }}" alt="Cat Icon" />
      <p class="footer-title">Naw's Patrol</p>
      <p class="footer-description">
        Hadir untuk membantu hewan terlantar menemukan harapan baru. Setiap laporan dan adopsi adalah langkah
        kecil untuk perubahan besar.
      </p>
    </div>
    
    <div class="footer-section">
      <img class="footer-email-icon" src="{{ asset('image/mark_email_unread.png') }}" alt="Email" />
      <p class="footer-title">Contact Us</p>
      <p class="footer-contact">(123) 456-789</p>
      <p class="footer-contact">kelompok4@gmail.com</p>
      <p class="footer-contact">Universitas Pendidikan Indonesia - Bandung</p>
    </div>
    
    <div class="footer-section">
      <p class="footer-title">Useful Links</p>
      <p class="footer-link">Adopsi</p>
      <p class="footer-link">Foster Home</p>
      <p class="footer-link">Laporan Hewan</p>
      <p class="footer-link">Donasi</p>
      <p class="footer-link">Edukasi</p>
    </div>
  </div>
  
  <p class="footer-copyright">© 2025 Naw's Patrol Developed by Kelompok 4 | All rights reserved.</p>
</footer>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>

* {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

.container.mx-auto {
    max-width: none !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
}

.dashboard-content {
  background-color: #fafafa;
  width: 100%;
  min-height: 100vh;
}

.dashboard-container {
  max-width: 1440px;
  margin: 0 auto;
  position: relative;
  padding: 40px 20px;
}

.about-section {
  max-width: 664px;
  margin: 60px 0 40px 0;
  padding: 0 20px;
}

.about-title {
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-size: 32px;
  margin-bottom: 15px;
}

.highlight {
  color: #faaf32;
}

.about-description {
  font-family: "Poppins", sans-serif;
  font-weight: 400;
  color: #3a3e47;
  font-size: 20px;
  line-height: 1.6;
  margin-bottom: 15px;
}

.about-mission {
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  color: #383f47;
  font-size: 20px;
  line-height: 1.6;
}

.hero-image {
  position: absolute;
  width: 567px;
  height: 502px;
  top: 100px;
  right: 50px;
  max-width: 40%;
}

.services-section {
  background-color: #f2f2f2;
  border-radius: 39px;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  padding: 60px 40px;
  margin: 100px 0;
  position: relative;
}

.services-header {
  text-align: center;
  margin-bottom: 60px;
}

.welcome-title {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
  color: #faaf32;
  margin-bottom: 7px;
}

.welcome-subtitle {
  font-family: "Poppins", sans-serif;
  font-weight: 400;
  color: #585958;
  font-size: 24px;
  line-height: 1.4;
  max-width: 900px;
  margin: 0 auto;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 30px;
  max-width: 1200px;
  margin: 0 auto;
}

.service-card {
  position: relative;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-background {
  width: 100%;
  height: 294px;
  background-color: #ffffff;
  border-radius: 23px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.service-icon {
  position: absolute;
  width: 50px;
  height: 50px;
  top: 16px;
  left: 50%;
  transform: translateX(-50%);
  object-fit: cover;
}

.card-content {
  position: absolute;
  top: 85px;
  left: 20px;
  right: 20px;
  text-align: center;
}

.service-title {
  font-family: "Poppins", sans-serif;
  font-weight: 700;
  color: #faaf32;
  font-size: 16px;
  margin-bottom: 9px;
}

.service-description {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  color: #3a3e47;
  font-size: 13px;
  line-height: 1.4;
}

.dashboard-footer {
  background-color: #d9d9d9;
  padding: 60px 40px 20px;
  margin-top: 50px;
}

.footer-content {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 40px;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-section {
  position: relative;
}

.footer-icon,
.footer-email-icon {
  width: 26px;
  height: 26px;
  margin-bottom: 10px;
}

.footer-title {
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  color: #000000;
  font-size: 16px;
  margin-bottom: 10px;
}

.footer-description,
.footer-contact,
.footer-link {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  color: #000000;
  font-size: 13px;
  line-height: 1.4;
  margin-bottom: 5px;
}

.footer-copyright {
  text-align: center;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  color: #000000;
  font-size: 13px;
  margin-top: 40px;
  padding-top: 20px;
  border-top: 1px solid #bbb;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .hero-image {
    position: relative;
    width: 100%;
    height: auto;
    max-width: 500px;
    margin: 40px auto;
    display: block;
    right: auto;
    top: auto;
  }
  
  .services-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .dashboard-container {
    padding: 20px 15px;
  }
  
  .about-section {
    margin: 20px 0;
    padding: 0 10px;
  }
  
  .about-title {
    font-size: 24px;
  }
  
  .about-description,
  .about-mission {
    font-size: 16px;
  }
  
  .services-section {
    padding: 40px 20px;
    margin: 40px 0;
  }
  
  .welcome-subtitle {
    font-size: 18px;
  }
  
  .services-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  
  .footer-content {
    grid-template-columns: 1fr;
    gap: 30px;
  }
}

@media (max-width: 480px) {
  .about-title {
    font-size: 20px;
  }
  
  .about-description,
  .about-mission {
    font-size: 14px;
  }
  
  .welcome-subtitle {
    font-size: 16px;
  }
  
  .services-section {
    padding: 30px 15px;
  }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
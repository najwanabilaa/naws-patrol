<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pelaporan Hewan Liar</title>
  <link rel="stylesheet" href="lapor.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <header class="navbar">
    <nav>
      <ul>
        <li><a href="">Profile</a></li>
        <li><a href="">Adopsi</a></li>
        <li><a href="register-foster.html">Foster</a></li>
        <li><a href="LaporHewan.html">Laporan Hewan Liar</a></li>
        <li><a href="">Donasi & Crowdfunding</a></li>
        <li><a href="edukasi.html" class="active">edukasi</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="camera-upload">
      <input type="file" id="uploadFoto" name="foto" accept="image/*" hidden />
      <label for="uploadFoto" class="camera-box">
        <img src="https://img.icons8.com/ios/100/camera--v1.png" alt="Camera Icon" id="previewFoto" />
      </label>
    </section>

    <section class="location">
      <p>
        <span class="location-icon"><i class="fa-solid fa-location-dot"></i></span>
        <a href="#" id="lokasi">Send your current location</a>
        <input type="hidden" id="lokasiValue" name="lokasi" />
      </p>
    </section>

    <section class="report-form">
      <h2>Pelaporan hewan liar</h2>
      <form action="/submit-laporan" method="POST">
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="nama" />
        </div>
        <div class="form-group">
          <label>Nomor hp</label>
          <input type="tel" name="telepon" />
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" />
        </div>
        <div class="form-group">
          <label>Alasan melapor</label>
          <input type="text" name="alasan" />
        </div>
        <button type="submit" class="submit-btn">Laporkan</button>
        <a href="#" class="terms-link">Baca Syarat Dan Ketentuan</a>
      </form>
    </section>
  </main>

  <script src="script"></script>
</body>
</html>
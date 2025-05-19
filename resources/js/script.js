const API_URL = 'http://localhost:8000/api';

const API_HEADERS = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
};

document.addEventListener('DOMContentLoaded', function() {
  if (document.getElementById('lokasi')) {
    initReportPage();
  }
});

function initReportPage() {
  document.getElementById("lokasi").addEventListener("click", handleLocation);
  document.getElementById("uploadFoto").addEventListener("change", handlePhotoUpload);
  document.querySelector('form').addEventListener('submit', handleFormSubmission);
}

function handleLocation(e) {
  e.preventDefault();
  
  if (!navigator.geolocation) {
    showAlert("Browser tidak mendukung geolocation.", "error");
    return;
  }
  
  showAlert("Mengambil lokasi...", "info");
  
  navigator.geolocation.getCurrentPosition(
    function(pos) {
      const lat = pos.coords.latitude;
      const lon = pos.coords.longitude;
      const link = `https://maps.google.com/?q=${lat},${lon}`;
      
      document.getElementById("lokasiValue").value = link;
      document.getElementById("lokasi").textContent = "Lokasi tersimpan!";
      showAlert("Lokasi berhasil disimpan", "success");
    },
    function(error) {
      const errorMessages = {
        1: "Izin lokasi ditolak",
        2: "Informasi lokasi tidak tersedia",
        3: "Waktu permintaan habis"
      };
      showAlert(errorMessages[error.code] || "Gagal mengambil lokasi", "error");
    }
  );
}

function handlePhotoUpload(e) {
  const file = e.target.files[0];
  if (!file) return;

  if (!file.type.match('image.*')) {
    showAlert("Hanya file gambar yang diperbolehkan", "error");
    return;
  }

  const reader = new FileReader();
  reader.onload = function(event) {
    document.getElementById('previewFoto').src = event.target.result;
  };
  reader.readAsDataURL(file);
}

async function handleFormSubmission(e) {
  e.preventDefault();
  
  const form = e.target;
  
  const formData = {
    nama: form.nama.value.trim(),
    telepon: form.telepon.value.trim(),
    alamat: form.alamat.value.trim(),
    alasan: form.alasan.value.trim(),
    lokasi: document.getElementById('lokasiValue').value,
    foto: document.getElementById('previewFoto').src,
    tanggal: new Date().toISOString().split('T')[0]
  };

  if (!formData.lokasi) {
    showAlert("Silakan ambil lokasi terlebih dahulu", "error");
    return;
  }

  if (!formData.nama || !formData.telepon || !formData.alasan) {
    showAlert("Harap isi semua field yang wajib diisi", "error");
    return;
  }

  const submitButton = form.querySelector('button[type="submit"]');
  const originalText = submitButton?.textContent;
  if (submitButton) {
    submitButton.disabled = true;
    submitButton.textContent = 'Menyimpan...';
  }

  try {
    await saveReportToAPI(formData);
    saveReportToLocalStorage(formData);
    
    form.reset();
    document.getElementById('previewFoto').src = "https://img.icons8.com/ios/100/camera--v1.png";
    document.getElementById("lokasi").textContent = "KLIK UNTUK LOKASI";
    
    showAlert("Laporan berhasil disimpan ke server!", "success");
  } catch (error) {
    console.error("Error saving report:", error);
    saveReportToLocalStorage(formData);
    
    if (error.message.includes('Failed to fetch')) {
      showAlert("Tidak dapat terhubung ke server. Laporan disimpan secara lokal.", "warning");
    } else {
      showAlert(`Error: ${error.message}. Laporan disimpan secara lokal.`, "warning");
    }
  } finally {
    if (submitButton) {
      submitButton.disabled = false;
      submitButton.textContent = originalText;
    }
  }
}

async function saveReportToAPI(reportData) {
  try {
    const response = await fetch(`${API_URL}/laporan`, {
      method: 'POST',
      headers: API_HEADERS,
      body: JSON.stringify(reportData)
    });
    
    if (response.status === 422) {
      const errorData = await response.json();
      const errorMessages = Object.values(errorData.errors || {}).flat();
      throw new Error(errorMessages.join(', ') || 'Validation error');
    }
    
    if (!response.ok) {
      const errorData = await response.json();
      throw new Error(errorData.message || `HTTP ${response.status}: ${response.statusText}`);
    }
    
    const data = await response.json();
    console.log('Report saved to Laravel API:', data);
    return data;
  } catch (error) {
    console.error('Error saving to Laravel API:', error);
    throw error;
  }
}

function saveReportToLocalStorage(reportData) {
  try {
    const reports = JSON.parse(localStorage.getItem('wildlifeReports') || '[]');
    
    const reportWithMeta = {
      id: Date.now().toString(),
      ...reportData,
      created_at: new Date().toISOString(),
      synced: false
    };
    
    reports.push(reportWithMeta);
    localStorage.setItem('wildlifeReports', JSON.stringify(reports));
    console.log("Report saved to localStorage:", reportWithMeta);
  } catch (error) {
    console.error("Error saving to localStorage:", error);
    showAlert("Gagal menyimpan laporan secara lokal", "error");
  }
}

async function getAllReports() {
  try {
    const response = await fetch(`${API_URL}/laporan`, {
      method: 'GET',
      headers: API_HEADERS
    });
    
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}: ${response.statusText}`);
    }
    
    const result = await response.json();
    const reports = result.data || result;
    console.log('Reports from Laravel API:', reports);
    return reports;
  } catch (error) {
    console.error('Error fetching reports from Laravel API:', error);
    showAlert("Tidak dapat mengambil data dari server, menggunakan data lokal", "warning");
    return JSON.parse(localStorage.getItem('wildlifeReports') || '[]');
  }
}

async function syncLocalReports() {
  try {
    const localReports = JSON.parse(localStorage.getItem('wildlifeReports') || '[]');
    const unsyncedReports = localReports.filter(report => !report.synced);
    
    for (const report of unsyncedReports) {
      try {
        await saveReportToAPI(report);
        report.synced = true;
      } catch (error) {
        console.error('Failed to sync report:', report.id, error);
      }
    }
    
    localStorage.setItem('wildlifeReports', JSON.stringify(localReports));
    
    if (unsyncedReports.length > 0) {
      showAlert(`${unsyncedReports.filter(r => r.synced).length} laporan berhasil disinkronisasi`, "success");
    }
  } catch (error) {
    console.error('Error syncing local reports:', error);
  }
}

function showAlert(message, type = "info") {
  const existingAlert = document.querySelector('.custom-alert');
  if (existingAlert) {
    existingAlert.remove();
  }

  const alert = document.createElement('div');
  alert.className = `custom-alert ${type}`;
  alert.textContent = message;
  
  document.body.appendChild(alert);
  setTimeout(() => alert.remove(), 3000);
}

document.addEventListener('DOMContentLoaded', function() {
});
function showPopup(message, isSuccess = true) {
    const existingPopup = document.querySelector('.popup-overlay');
    if (existingPopup) {
        existingPopup.remove();
    }

    const popupOverlay = document.createElement('div');
    popupOverlay.className = 'popup-overlay';
    
    const popup = document.createElement('div');
    popup.className = `popup ${isSuccess ? 'popup-success' : 'popup-error'}`;
    
    const popupContent = document.createElement('div');
    popupContent.className = 'popup-content';
    
    const icon = document.createElement('div');
    icon.className = 'popup-icon';
    
    if (isSuccess) {
        icon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32">
                <path fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        `;
    } else {
        icon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32">
                <path fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" d="M18 6L6 18M6 6l12 12"/>
            </svg>
        `;
    }
    
    const messageEl = document.createElement('p');
    messageEl.textContent = message;
    
    const closeBtn = document.createElement('button');
    closeBtn.className = 'popup-close';
    closeBtn.textContent = 'OK';
    closeBtn.onclick = () => {
        popupOverlay.remove();
    };
    
    popupContent.appendChild(icon);
    popupContent.appendChild(messageEl);
    popupContent.appendChild(closeBtn);
    popup.appendChild(popupContent);
    popupOverlay.appendChild(popup);
    
    document.body.appendChild(popupOverlay);
    
    if (!document.querySelector('#popup-styles')) {
        const style = document.createElement('style');
        style.id = 'popup-styles';
        style.textContent = `
            .popup-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
                animation: fadeIn 0.3s ease-in-out;
            }
            
            .popup {
                background: white;
                border-radius: 15px;
                padding: 0;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                animation: slideIn 0.3s ease-out;
                max-width: 350px;
                width: 90%;
            }
            
            .popup-success {
                border-top: 5px solid #4CAF50;
            }
            
            .popup-error {
                border-top: 5px solid #f44336;
            }
            
            .popup-content {
                padding: 30px;
                text-align: center;
            }
            
            .popup-icon {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                margin: 0 auto 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
            }
            
            .popup-icon svg {
                width: 30px;
                height: 30px;
            }
            
            .popup-success .popup-icon {
                background-color: #4CAF50;
            }
            
            .popup-error .popup-icon {
                background-color: #f44336;
            }
            
            .popup-content p {
                margin: 0 0 25px 0;
                font-size: 16px;
                color: #333;
                line-height: 1.5;
            }
            
            .popup-close {
                background-color: #2B6ED6;
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 25px;
                cursor: pointer;
                font-size: 14px;
                font-weight: bold;
                transition: background-color 0.3s;
            }
            
            .popup-close:hover {
                background-color: #1e5bb8;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            @keyframes slideIn {
                from { 
                    opacity: 0;
                    transform: translateY(-50px) scale(0.8);
                }
                to { 
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
        `;
        document.head.appendChild(style);
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^[0-9+\-\s()]{10,15}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
}

function toggleSwitch() {
    const switchElement = document.querySelector('.switch::before');
    const currentPage = document.title;
    
    const style = document.createElement('style');
    style.textContent = `
        .switch::before {
            transform: translateX(10px);
            transition: 0.3s;
        }
    `;
    document.head.appendChild(style);
    
    setTimeout(() => {
        style.remove();
    }, 300);
    
    if (currentPage.includes('Login')) {
        handleLogin();
    } else if (currentPage.includes('Register')) {
        handleRegister();
    }
}

function handleLogin() {
    const email = document.querySelector('input[type="email"]').value.trim();
    const password = document.querySelector('input[type="password"]').value.trim();
    
    if (!email || !password) {
        showPopup('Mohon isi semua field!', false);
        return;
    }
    
    if (!isValidEmail(email)) {
        showPopup('Format email tidak valid!', false);
        return;
    }
    
    if (password.length < 6) {
        showPopup('Password minimal 6 karakter!', false);
        return;
    }
    
    setTimeout(() => {
        if (email.includes('@') && password.length >= 6) {
            localStorage.setItem('userSession', JSON.stringify({
                email: email,
                loginTime: new Date().toISOString()
            }));
            
            showPopup('Login berhasil! Selamat datang di Naw\'s Patrol!', true);
            
            setTimeout(() => {
                window.location.href = 'landing.html';
            }, 2000);
        } else {
            showPopup('Email atau password salah!', false);
        }
    }, 500);
}

function handleRegister() {
    const name = document.querySelector('input[type="text"]').value.trim();
    const email = document.querySelector('input[type="email"]').value.trim();
    const password = document.querySelector('input[type="password"]').value.trim();
    const phone = document.querySelectorAll('input[type="text"]')[1].value.trim();
    
    if (!name || !email || !password || !phone) {
        showPopup('Mohon isi semua field!', false);
        return;
    }
    
    if (name.length < 2) {
        showPopup('Nama minimal 2 karakter!', false);
        return;
    }
    
    if (!isValidEmail(email)) {
        showPopup('Format email tidak valid!', false);
        return;
    }
    
    if (password.length < 6) {
        showPopup('Password minimal 6 karakter!', false);
        return;
    }
    
    if (!isValidPhone(phone)) {
        showPopup('Format nomor telepon tidak valid!', false);
        return;
    }
    
    setTimeout(() => {
        if (email.toLowerCase().includes('test')) {
            showPopup('Email sudah terdaftar! Gunakan email lain.', false);
        } else {
            const userData = {
                name: name,
                email: email,
                phone: phone,
                registerTime: new Date().toISOString()
            };
            
            localStorage.setItem('registeredUser', JSON.stringify(userData));
            
            showPopup('Registrasi berhasil! Selamat bergabung dengan Naw\'s Patrol!', true);
            
            setTimeout(() => {
                window.location.href = 'landing.html';
            }, 2000);
        }
    }, 500);
}

document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input');
    
    inputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                toggleSwitch();
            }
        });
    });
    
    if (inputs.length > 0) {
        inputs[0].focus();
    }
});

function clearForm() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.value = '';
    });
}

function checkUserSession() {
    const session = localStorage.getItem('userSession');
    if (session) {
        return JSON.parse(session);
    }
    return null;
}
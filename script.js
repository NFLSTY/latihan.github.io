function setSapaan() {
    const jam = new Date().getHours();
    const elemenSapaan = document.getElementById('ucapan-sapaan');
    if (!elemenSapaan) {
        return;
    }
 
    let teksSapaan = 'Selamat Datang!';
 
    if (jam >= 5 && jam < 12) {
        teksSapaan = 'Selamat Pagi!';
    } else if (jam >= 12 && jam < 15) {
        teksSapaan = 'Selamat Siang!';
    } else if (jam >= 15 && jam < 18) {
        teksSapaan = 'Selamat Sore!';
    } else {
        teksSapaan = 'Selamat Malam!';
    }
 
    elemenSapaan.textContent = teksSapaan;
}
 
function setTahun() {
    const elemenTahun = document.getElementById('tahun');
    if (!elemenTahun) {
        return;
    }
    elemenTahun.textContent = new Date().getFullYear();
}
 
function initContactForm() {
    const form = document.getElementById('contactForm');
    const successMsg = document.getElementById('successMsg');
    if (!form || !successMsg) {
        return;
    }
 
    form.addEventListener('submit', function (event) {
        event.preventDefault();
 
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
 
        if (!name || !email || !message) {
            alert('Silakan isi semua field!');
            return;
        }
 
        console.log('Nama:', name);
        console.log('Email:', email);
        console.log('Pesan:', message);
 
        successMsg.style.display = 'block';
        form.reset();
 
        setTimeout(function () {
            successMsg.style.display = 'none';
        }, 3000);
    });
}
 
window.addEventListener('load', function () {
    setSapaan();
    setTahun();
    initContactForm();
});
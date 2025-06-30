<p align="center">
  <img src="https://github.com/muhammadfariddd/Fileswift/blob/master/public/images/logo-new.png" alt="Fileswift Logo" width="300">
</p>
<p align="center"><strong>Sistem Manajemen File Fullstack dengan Laravel + Tailwind CSS</strong></p>

---

**Fileswift** adalah aplikasi manajemen file fullstack yang modern, responsif, dan efisien. Dirancang untuk memudahkan proses **unggahan**, **penyimpanan**, dan **penampilan file** secara cepat dan aman. Backend dibangun menggunakan **Laravel**, sedangkan frontend menggunakan **Tailwind CSS** untuk tampilan minimalis yang tetap menarik di berbagai perangkat.

---

## ✨ Fitur Utama

- ✅ **Backend Laravel** — Penanganan request, validasi, dan penyimpanan file yang aman.
- ✅ **UI Responsif dan Modern** — Dibangun dengan Tailwind CSS untuk tampilan ringan dan mobile-friendly.
- ✅ **Unggah File Mudah** — Pilih file dari perangkat, lalu unggah langsung ke server.

---

## 🖼️ Tampilan Aplikasi

- 🏠 Home Section
  
![image](https://github.com/user-attachments/assets/9d467731-968f-43d9-ba27-9a5a96fe2110)

- 📤 Halaman Unggah File
  
![image](https://github.com/user-attachments/assets/fc5c1dde-9daa-4d37-8c9f-e9a2588962e6)

---

## 🛠️ Tumpukan Teknologi

| Komponen   | Teknologi           | Deskripsi                                                  |
|------------|---------------------|-------------------------------------------------------------|
| **Backend** | Laravel             | Framework PHP modern untuk RESTful API dan validasi        |
| **Frontend** | Blade + Tailwind CSS | UI responsif dan elegan tanpa CSS tambahan                |
|            | Alpine.js | Untuk menambahkan interaktivitas ringan jika dibutuhkan |

---

## 🚀 Cara Memulai

Ikuti panduan berikut untuk menjalankan Fileswift secara lokal di perangkat Anda.

### 🧾 Prasyarat

- PHP >= 8.1
- Composer
- Node.js + npm
- Git
- MySQL / SQLite *(opsional untuk fitur tambahan)*

---

### ⚙️ Instalasi

1. **Clone repositori**
   ```bash
   git clone https://github.com/muhammadfariddd/fileswift-laravel.git
   cd fileswift-laravel
   ```

2. **Clone repositori**
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan storage:link
   ```
   
3. **Instal dan build frontend**
   ```bash
   npm install
   npm run dev
   ```

4. **Jalankan server lokal**
   ```bash
   php artisan serve
   ```

---

## 📂 Struktur Proyek

```bash
/fileswift-laravel
├── app/                  # Logika aplikasi Laravel
├── public/               # Aset publik (file upload tersimpan di sini)
├── resources/
│   └── views/            # Template Blade untuk frontend
├── routes/
│   └── web.php           # Rute aplikasi web
├── storage/app/public/   # Lokasi penyimpanan file upload
├── .env.example          # Contoh konfigurasi aplikasi
├── tailwind.config.js    # Konfigurasi Tailwind CSS
├── package.json          # Dependensi frontend
└── README.md             # Dokumentasi proyek
```

## 🤝 Kontribusi
Kami sangat terbuka terhadap kontribusi! Ikuti langkah-langkah berikut untuk berkontribusi:

1. Fork repositori ini.

2. Buat branch fitur baru:
```bash
git checkout -b fitur/NamaFitur
```

3. Commit perubahan:
```bash
git commit -m "Menambahkan fitur X"
```

4. Push ke repo Anda:
```bash
git push origin fitur/NamaFitur
```

5. Buka Pull Request ke branch main.

---


<p align="center">© 2025 Fileswift - Made with ❤️ in Indonesia</p> 

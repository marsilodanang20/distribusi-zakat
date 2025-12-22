# Sistem Informasi Distribusi Zakat

Aplikasi berbasis web untuk pengelolaan zakat, infaq, dan shodaqoh yang mencakup pengumpulan dari Muzakki hingga distribusi ke Mustahik, dilengkapi dengan pelaporan dan CMS sederhana.

![Preview](https://github.com/marsilodanang20/distribusi-zakat/blob/main/public/images/splide/preview.png)

## 🚀 Fitur Utama

### 🏠 Frontend (Public)
- **Beranda**: Halaman utama informasi zakat.
- **Tentang Kami**: Informasi profil lembaga/masjid.
- **Artikel**: Blog/Berita seputar kegiatan zakat.
- **Galeri**: Dokumentasi kegiatan.
- **Kontak**: Formulir hubungi kami.

### 🔐 Backend (Admin Dashboard)
- **Dashboard**: Statistik ringkas pengumpulan dan distribusi zakat.
- **Manajemen Warga**:
  - **Data Muzakki**: Pengelolaan data donatur zakat.
  - **Data Mustahik**: Pengelolaan data penerima zakat.
  - **Kategori Mustahik**: Pengaturan golongan mustahik (Fakir, Miskin, Amil, dll).
- **Transaksi Zakat**:
  - **Pengumpulan Zakat**: Form pencatatan penerimaan zakat (Fitrah/Mal).
  - **Distribusi Zakat**: Form pencatatan penyaluran zakat ke mustahik.
- **Laporan**:
  - Laporan Pengumpulan (Rekapitulasi masuk).
  - Laporan Distribusi (Rekapitulasi keluar).
- **Manajemen Konten (CMS)**:
  - Kelola Artikel.
  - Kelola Galeri.

## 🛠️ Teknologi yang Digunakan

- **Backend Framework**: [Laravel 10](https://laravel.com)
- **Language**: PHP ^8.1
- **Database**: MySQL
- **Frontend**:
  - [Tailwind CSS](https://tailwindcss.com) - Framework CSS utility-first.
  - [Alpine.js](https://alpinejs.dev) - Framework JavaScript ringan.
  - [Bootstrap 5](https://getbootstrap.com) - Komponen UI (Opsional/Integrasi).
  - Blade Templates - Templating engine bawaan Laravel.
- **Packages**:
  - `yajra/laravel-datatables`: Data tables server-side yang responsif.
  - `laravel/breeze`: Sistem autentikasi yang ringan.
- **Build Tool**: [Vite](https://vitejs.dev)

## ⚙️ Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL Database

## 📦 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lokal komputer Anda:

1. **Clone Repository**
   ```bash
   git clone https://github.com/marsilodanang20/distribusi-zakat.git
   cd distribusi-zakat
   ```

2. **Install Dependencies (Backend)**
   ```bash
   composer install
   ```

3. **Install Dependencies (Frontend)**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Atur konfigurasi database di file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database**
   Jalankan migrasi untuk membuat tabel-tabel yang dibutuhkan (dan seeder jika ada):
   ```bash
   php artisan migrate
   ```

7. **Jalankan Project**
   Buka dua terminal terpisah untuk menjalankan server Laravel dan Vite:

   *Terminal 1 (Laravel Server):*
   ```bash
   php artisan serve
   ```

   *Terminal 2 (Vite Build Watch):*
   ```bash
   npm run dev
   ```

8. **Akses Aplikasi**
   Buka browser dan kunjungi: `http://localhost:8000`

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

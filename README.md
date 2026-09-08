# Sistem Informasi Akademik & Chatbot (CodeIgniter 3)

Aplikasi web berbasis CodeIgniter 3 untuk pengelolaan data akademik (mahasiswa, buku, user) yang dilengkapi dengan modul integrasi Chatbot AI dan REST API.

---

## Fitur Utama

1. **Autentikasi & Otorisasi**: Login, Register, dan Session Management (Role User / Admin).
2. **Manajemen Data Mahasiswa**: CRUD data mahasiswa lengkap dengan upload foto dan export PDF (Dompdf).
3. **Manajemen Data Buku**: Pencatatan dan pengelolaan katalog buku.
4. **Modul Chatbot AI**: Integrasi API chatbot (OpenRouter / Model AI eksternal) dengan mode fallback lokal.
5. **REST API**: Endpoint API JSON untuk integrasi data mahasiswa (`GET` / `POST`) menggunakan otentikasi API Key (`X-API-KEY`).

---

## Kebutuhan Sistem

- PHP 7.4 - 8.x
- Web Server (Apache / Laragon / XAMPP)
- MySQL / MariaDB
- Ekstensi PHP: `mysqli`, `curl`, `mbstring`, `gd`

---

## Panduan Instalasi

### 1. Clone Repositori
```bash
git clone https://github.com/USERNAME/NAMA-REPO.git
cd NAMA-REPO
```

### 2. Konfigurasi Database
1. Buat database baru di MySQL/phpMyAdmin, misalnya: `db_akademik`.
2. Impor struktur tabel dari file `tabel.sql`.
3. Buka file [application/config/database.php](file:///c:/laragon/www/project-ci3/application/config/database.php) dan sesuaikan kredensial database Anda:
   ```php
   'hostname' => 'localhost',
   'username' => 'root',
   'password' => '',
   'database' => 'db_akademik',
   ```

### 3. Konfigurasi Base URL
Buka [application/config/config.php](file:///c:/laragon/www/project-ci3/application/config/config.php) dan sesuaikan `base_url`:
```php
$config['base_url'] = 'http://localhost/project-ci3/';
```

### 4. Menjalankan Aplikasi
Akses aplikasi melalui browser:
```text
http://localhost/project-ci3/
```

---

## Dokumentasi REST API

Semua request API memerlukan header:
```http
X-API-KEY: Mahasiswa123
Content-Type: application/json
```

### 1. Ambil Semua Data Mahasiswa
- **Method**: `GET`
- **Endpoint**: `/api/get_data`
- **Response**:


---

## Lisensi
Proyek ini dikembangkan untuk kebutuhan akademik menggunakan framework CodeIgniter 3.

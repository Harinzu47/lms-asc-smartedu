# LMS ASC SmartEdu

Sistem Manajemen Pembelajaran (LMS) modern yang dibangun dengan **Laravel**, **Livewire**, dan **Flux UI**. Proyek ini dirancang untuk memfasilitasi manajemen jadwal, materi, tugas, dan presensi antara Admin, Tutor, dan Siswa.

## 🚀 Fitur Utama

-   **Manajemen Jadwal Cerdas**:
    -   Anti-bentrok jadwal (Tutor & Kelas).
    -   Sistem penugasan Siswa module _Many-to-Many_ (Siswa di-assign per Jadwal, bukan hanya per Kelas).
-   **Monitoring Admin**:
    -   Pantau aktifitas kelas (Materi, Tugas, Diskusi).
    -   Audit Presensi (Hadir, Sakit, Izin, Alpha).
    -   Detail Pengumpulan Tugas (Status, File, Nilai).
-   **Role-Based Access**:
    -   **Admin**: Mengelola Master Data, Jadwal, dan Monitoring.
    -   **Tutor**: Mengelola Materi, Tugas, dan Input Presensi.
    -   **Siswa**: Mengakses Materi, Mengumpulkan Tugas, dan Melihat Jadwal.

## 🛠️ Teknologi

-   **Backend**: Laravel 11 / 12 (PHP 8.2+)
-   **Frontend**: Livewire 3 + Alpine.js
-   **UI Components**: Flux UI, Tailwind CSS
-   **Database**: MySQL

## 📋 Prasyarat

Sebelum memulai, pastikan Anda memiliki:

-   [PHP 8.2](https://www.php.net/downloads) atau lebih baru.
-   [Composer](https://getcomposer.org/).
-   [Node.js](https://nodejs.org/) & NPM.
-   MySQL Database.

## 📦 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lokal komputer Anda:

1.  **Clone Repository**

    ```bash
    git clone https://github.com/Harinzu47/lms-asc-smartedu.git
    cd lms-asc-smartedu
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file contoh `.env` dan sesuaikan konfigurasi database Anda.

    ```bash
    cp .env.example .env
    ```

    Buka file `.env` dan atur detail database:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate App Key**

    ```bash
    php artisan key:generate
    ```

5.  **Migrasi & Seeding Database**
    Jalankan migrasi untuk membuat tabel dan seeder untuk data awal (User Role, Admin default, dll).

    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi**
    Buka dua terminal terpisah:

    _Terminal 1 (Vite Development Server):_

    ```bash
    npm run dev
    ```

    _Terminal 2 (Laravel Server):_

    ```bash
    php artisan serve
    ```

7.  **Akses Aplikasi**
    Buka browser dan kunjungi `http://localhost:8000`.

## 🖥️ Cara Push ke GitHub (JIKA ANDA PEMILIK REPO)

1.  Pastikan remote sudah diset:
    ```bash
    git remote -v
    ```
2.  Push kode:
    ```bash
    git push origin main
    ```

## 🔑 Akun Demo (Default Seeder)

Jika menggunakan `DatabaseSeeder` bawaan:

-   **Admin**: `admin@asc.com` / `password`
-   **Tutor**: `tutor@asc.com` / `password`
-   **Siswa**: `siswa@asc.com` / `password`

---

Made with ❤️ by ASC Team.

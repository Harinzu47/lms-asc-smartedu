PROJECT_CONTEXT.md (Kitab Suci ASC SmartEdu)

1. Project Overview
   Nama Aplikasi: ASC SmartEdu (Learning Management System) Klien: Arrhenius Study Center (ASC) Deskripsi: Sistem LMS berbasis web untuk memfasilitasi Blended Learning. Sistem ini menangani pendaftaran siswa, penjadwalan kelas, distribusi materi pelajaran, dan pengumpulan tugas secara digital untuk menggantikan proses manual (Excel/WhatsApp).

2. Tech Stack (Strict)
   Framework: Laravel 12 (PHP 8.2+)

Frontend: Blade Templates + Livewire 3 (Fullstack Components)

Styling: Tailwind CSS (via Vite)

Database: MySQL

Icons: Heroicons (via Blade UI Kit)

Admin Panel: Custom Livewire Components (DILARANG menggunakan FilamentPHP atau generator admin lain).

3. Database Schema (Revised & Normalized)
   Gunakan skema ini sebagai acuan mutlak untuk Migration.

A. Users & Roles (Single Table Inheritance)
Tabel: users

id: Primary Key

name: String

email: String (Unique)

password: String

role: Enum ['admin', 'tutor', 'siswa']

nomor_telepon: String (Nullable)

alamat: Text (Nullable)

status_aktif: Boolean (Default: false untuk siswa, true untuk admin/tutor) - Untuk fitur verifikasi pendaftaran

bukti_pembayaran: String (Nullable, Path file gambar) - Untuk upload bukti transfer saat registrasi

kelas_id: ForeignId (Nullable, Constrained to kelas) - Khusus Siswa

B. Master Data
Tabel: kelas

id: Primary Key

nama_kelas: String (Contoh: "10 IPA 1", "12 Intensif")

Tabel: mata_pelajarans

id: Primary Key

nama_mapel: String (Contoh: "Matematika", "Fisika")

C. Akademik & Penjadwalan
Tabel: jadwals

id: Primary Key

tutor_id: ForeignId (Constrained users)

mapel_id: ForeignId (Constrained mata_pelajarans)

kelas_id: ForeignId (Constrained kelas)

hari: String (Senin, Selasa, dst)

jam_mulai: Time

jam_selesai: Time

D. Learning Content (Materi & Tugas)
Tabel: materis

id: Primary Key

jadwal_id: ForeignId (Constrained jadwals)

judul: String

file_path: String (PDF/Docx)

deskripsi: Text (Nullable)

Tabel: tugas

id: Primary Key

jadwal_id: ForeignId (Constrained jadwals)

judul: String

deskripsi: Text

batas_waktu: DateTime

Tabel: pengumpulan_tugas (Submissions)

id: Primary Key

tugas_id: ForeignId (Constrained tugas)

siswa_id: ForeignId (Constrained users)

file_jawaban: String (Path file)

nilai: Integer (Nullable) - Diisi oleh Tutor

tanggal_dikumpul: Timestamp

4. Fitur & Alur Logika (Business Logic)
   A. Autentikasi & Registrasi

Registrasi Siswa: Siswa mendaftar mandiri, mengisi data diri, dan Wajib upload bukti pembayaran.

Verifikasi: Akun siswa status default-nya non-aktif. Admin harus memverifikasi bukti bayar di dashboard, lalu mengubah status menjadi aktif agar siswa bisa login.

Login: Menggunakan satu form login, redirect user berdasarkan role (Admin ke /admin, Tutor ke /tutor, Siswa ke /dashboard).

B. Role: Admin
User Management: CRUD untuk Tutor dan Siswa. Bisa reset password user.

Master Data: CRUD Kelas dan Mata Pelajaran.

Penjadwalan: Membuat jadwal kelas.

Validasi Logic: Sistem harus menolak jika Tutor yang sama dijadwalkan di dua kelas berbeda pada jam yang sama (Bentrok).

C. Role: Tutor

Dashboard Tutor: Melihat jadwal mengajar hari ini.

Manajemen Kelas:

Masuk ke detail jadwal.

Tab Materi: Upload/Edit/Hapus materi (File PDF/Doc).

Tab Tugas: Buat tugas baru, set deadline.

Tab Penilaian: Melihat list siswa yang sudah upload tugas dan memberi nilai (0-100).

D. Role: Siswa
Dashboard Siswa: Melihat jadwal pelajaran hari ini dan pengumuman.

Ruang Kelas:

Melihat list materi dan download file.

Melihat list tugas aktif.

Upload Tugas: Form upload file jawaban. Hanya bisa upload sebelum batas_waktu.

5. UI/UX Guidelines
   Framework: Tailwind CSS.

Desain: Clean, dominasi warna Putih & Tosca/Hijau (Sesuai nuansa logo ASC di dokumen).

Layout:

Guest: Navbar transparan untuk Landing Page.

App Layout (Admin/Tutor): Sidebar kiri (Collapsible), Topbar user info.

Student Layout: Topbar navigation (Simple & Fokus konten).

Responsiveness: Semua tabel harus bisa di-scroll horizontal di mobile (overflow-x-auto). Sidebar harus jadi hamburger menu di mobile.

6. Coding Standards (Laravel 12 & Livewire)
   Gunakan Livewire Class Components (bukan Volt).

Gunakan Eloquent Relationships di model, jangan query builder manual di controller jika tidak perlu.

Gunakan Form Request atau Livewire validation rules (#[Rule]) untuk validasi input.

File Upload wajib menggunakan Livewire\WithFileUploads.

Gunakan Storage::disk('public') untuk menyimpan file materi dan tugas.

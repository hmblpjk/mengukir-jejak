# Mengukir Jejak
Mengukir Jejak (Bahasa Inggris: Carving a Trail) adalah aplikasi web blog sederhana yang dibangun menggunakan PHP native dan database MySQL. Proyek ini mencakup fitur-fitur dasar sebuah Content Management System (CMS), seperti antarmuka publik untuk membaca artikel dan panel admin untuk mengelola konten, kategori, dan penulis.

# Fitur
Aplikasi ini dibagi menjadi dua bagian utama: halaman publik dan panel admin.

**Halaman Publik**
1. Beranda: Menampilkan artikel terbaru dan daftar artikel lainnya.
2. Halaman Detail Artikel: Menampilkan isi lengkap sebuah artikel, penulis, tanggal, kategori, dan gambar.
3. Halaman Kategori: Menampilkan semua artikel yang termasuk dalam kategori tertentu.
4. Daftar Artikel Terkait: Menampilkan artikel lain dalam kategori yang sama di halaman detail.
5. Halaman Tentang: Halaman statis untuk deskripsi blog.
6. Halaman Kontak: Halaman statis dengan formulir kontak.
7. Desain Responsif: Dibangun dengan Bootstrap 5 agar dapat diakses di berbagai perangkat.

**Panel Admin**
1. Otentikasi Aman: Halaman login dan logout untuk admin/penulis.
2. Manajemen Artikel (CRUD):
    <li>
      <ul>Create: Menambahkan artikel baru melalui form dengan editor WYSIWYG (CKEditor).</ul>
      <ul>Read: Melihat daftar semua artikel dalam format tabel.</ul>
      <ul>Update: Mengedit artikel yang sudah ada.</ul>
      <ul>Delete: Menghapus artikel.</ul>
    </li>
4. Manajemen Kategori (CRUD): Fungsi untuk menambah, mengubah, dan menghapus kategori artikel (berdasarkan struktur kode).
5. Manajemen Penulis (CRUD): Fungsi untuk menambah, mengubah, dan menghapus data penulis (berdasarkan struktur kode).
6. Unggah Gambar: Kemampuan untuk mengunggah gambar sampul untuk setiap artikel.
7. Perlindungan Halaman: Akses ke halaman admin dilindungi oleh sesi login.

# Teknologi yang Digunakan
Backend: PHP 7/8
Database: MySQL (dikelola melalui mysqli)
Frontend: HTML, CSS, JavaScript
Framework/Library:
Bootstrap 5
CKEditor 5
Simple-DataTables

# Prasyarat
Web Server (misalnya, Apache)
PHP (versi 7.4 atau lebih baru direkomendasikan)
Database MySQL atau MariaDB
Anda dapat menggunakan paket server lokal seperti XAMPP atau WampServer untuk memenuhi semua prasyarat ini dengan mudah.

# Instalasi dan Konfigurasi
Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

Clone Repositori

Bash

git clone https://github.com/username/nama-repositori.git
Pindahkan semua file ke direktori root web server Anda (misalnya, C:/xampp/htdocs/blog-mengukir-jejak).

Buat Database

Buka phpMyAdmin (http://localhost/phpmyadmin).
Buat database baru dengan nama db_blog.
Impor Struktur Database

Buka tab SQL di phpMyAdmin.
Salin dan jalankan query SQL berikut untuk membuat tabel yang diperlukan:
Konfigurasi Koneksi Database

Buka file admin/function.php.
Sesuaikan variabel koneksi database dengan pengaturan lokal Anda
Buat Akun Admin Pertama

Karena tidak ada fitur registrasi, Anda perlu membuat akun penulis/admin pertama secara manual.
Jalankan perintah SQL berikut di phpMyAdmin. Ini akan membuat pengguna dengan email admin@example.com dan password admin123.
Jalankan Aplikasi

Buka browser dan akses URL proyek Anda: http://localhost/nama-folder-proyek.
Untuk masuk ke panel admin, buka: http://localhost/nama-folder-proyek/admin/login.php.
Gunakan kredensial yang Anda buat pada langkah 5.

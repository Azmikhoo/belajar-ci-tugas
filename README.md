Proyek "Toko" adalah aplikasi E-Commerce berbasis CodeIgniter 4 yang dikembangkan sebagai tugas Ujian Akhir Semester (UAS) mata kuliah Pemrograman Web Lanjut. Aplikasi ini mengintegrasikan berbagai fungsionalitas inti sebuah toko online, mulai dari manajemen produk dan transaksi, hingga fitur diskon dinamis dan konsumsi webservice eksternal.

Berikut adalah rangkuman fitur dan detail proyek:

Fitur Utama Aplikasi
Pengelolaan Pengguna & Autentikasi:

Mendukung peran pengguna Admin dan Guest dengan sistem login/logout berbasis sesi.

Halaman utama (Dashboard) menampilkan daftar produk.


Notifikasi Diskon Dinamis: Header website otomatis menampilkan informasi diskon harian yang berlaku, diproses melalui BaseController untuk memastikan ketersediaan data di setiap halaman.

Manajemen Data:

Produk & Kategori: Admin dapat melakukan operasi CRUD (Create, Read, Update, Delete) pada data produk dan kategori melalui antarmuka modal.


Diskon (Admin Saja): Terdapat menu khusus untuk admin mengelola diskon harian, termasuk validasi untuk mencegah duplikasi diskon pada tanggal yang sama dan input tanggal yang readonly saat mengedit.

Transaksi & Keranjang Belanja:

Keranjang Belanja: Pengguna dapat menambah, mengubah kuantitas, menghapus, atau mengosongkan item di keranjang.


Diskon Otomatis: Diskon yang berlaku secara otomatis diterapkan pada harga produk saat ditambahkan ke keranjang.

Checkout & Ongkos Kirim: Proses checkout terintegrasi dengan API RajaOngkir untuk perhitungan ongkos kirim dinamis.

Penyimpanan Transaksi: Detail transaksi, termasuk harga diskon dan ongkir, disimpan ke database.


Riwayat Transaksi: Pengguna dapat melihat riwayat dan mengubah status transaksi mereka di halaman profil.

Webservice & Dashboard Eksternal:


API Transaksi: Aplikasi menyediakan endpoint API (/api/uas-report) yang mengeluarkan data semua transaksi dalam format JSON, termasuk total jumlah item per transaksi.


Dashboard Sederhana Eksternal: Terdapat aplikasi dashboard terpisah (berada di public/dashboard-toko) yang mengkonsumsi data dari API ini dan menampilkannya dalam tabel.

Kebutuhan Sistem & Instalasi
Persyaratan Sistem:

PHP 7.4+

Composer

Web Server (Apache/Nginx atau php spark serve)

MySQL/MariaDB

Ekstensi PHP 

intl dan curl.

Langkah Instalasi:

Clone repositori GitHub proyek.

Masuk ke direktori proyek.

Jalankan composer install untuk menginstal dependensi.

Salin 

env menjadi .env dan konfigurasikan CI_ENVIRONMENT, app.baseURL, kredensial database (database.default.hostname, database.default.database, database.default.username, database.default.password), dan COST_KEY (API key RajaOngkir Anda).

Jalankan 

php spark migrate untuk membuat tabel database.

Jalankan 

php spark db:seed UserSeeder dan php spark db:seed DiskonSeeder untuk mengisi data awal.

Jalankan 

php spark serve untuk memulai server pengembangan dan akses aplikasi di http://localhost:8080.

Struktur Proyek
Proyek ini mengikuti arsitektur Model-View-Controller (MVC) CodeIgniter 4:

app/: Berisi kode inti aplikasi.

Controllers/: Mengelola permintaan pengguna, berkomunikasi dengan Model, dan mengirim data ke View. Contoh: 

BaseController (untuk diskon header), HomeController, AuthController, ProdukController, TransaksiController, ApiController (untuk webservice), dan Admin/Diskon.php (untuk manajemen diskon admin).


Models/: Mengelola interaksi dengan database, seperti ProductModel, TransactionModel (dengan metode getTransaksiForApi() untuk data jumlah item), dll.


Views/: Berisi semua file UI (HTML + PHP), termasuk layout.php, komponen seperti header.php dan sidebar.php, serta view spesifik halaman dan sub-direktori admin/diskon/.


Database/: Mengelola skema tabel (Migrations/) dan data awal (Seeds/).


Filters/: Berisi kelas filter seperti AuthFilter (untuk memeriksa login) dan RedirectFilter (untuk mencegah akses halaman login jika sudah login).


Config/: Direktori konfigurasi CodeIgniter, termasuk Routes.php (mendefinisikan URL dan menerapkan filter).

public/: Direktori yang dapat diakses publik. Berisi 

index.php (titik masuk aplikasi), aset (CSS, JS, gambar), dan folder dashboard-toko/ untuk aplikasi dashboard eksternal.


.env: File konfigurasi lingkungan lokal, tidak boleh di-commit ke Git karena berisi informasi sensitif.
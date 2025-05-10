# Janji
Saya Nuansa Bening Aura Jelita dengan NIM 2301410 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek 
untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program
Program ini dibangun menggunakan arsitektur Model-View-Presenter (MVP) untuk mengelola data mahasiswa dengan bahasa pemrograman PHP. MVP adalah pola arsitektur yang memisahkan aplikasi menjadi tiga komponen utama:

## 1. Model
- Bertanggung jawab untuk mengelola data dan logika bisnis
- Menangani operasi database melalui kelas-kelas seperti:
  - `DB.class.php`: Menangani koneksi database
  - `Mahasiswa.class.php`: Representasi objek mahasiswa
  - `TabelMahasiswa.class.php`: Operasi CRUD untuk data mahasiswa

## 2. View
- Bertanggung jawab untuk menampilkan data kepada pengguna
- Merender antarmuka pengguna melalui:
  - `TampilMahasiswa.php`: Menampilkan data mahasiswa dalam bentuk tabel
  - `Template.class.php`: Engine templating untuk menghasilkan HTML
  - Template HTML: `skin.html` dan `form.html`

## 3. Presenter
- Bertindak sebagai perantara antara Model dan View
- Menerima input pengguna dari View dan memproses data dari Model
- Diimplementasikan melalui:
  - `ProsesMahasiswa.php`: Memproses operasi CRUD untuk mahasiswa
  - Interface `KontrakPresenter.php`: Mendefinisikan metode wajib untuk presenter
    
### Database (mvp_php)
Tabel: `mahasiswa`

| Kolom | Tipe | Deskripsi |
|--------|------|-------------|
| id | INT(11) NOT NULL | Identifikasi unik untuk setiap mahasiswa |
| nim | VARCHAR(100) NOT NULL | Nomor Induk Mahasiswa |
| nama | VARCHAR(100) NOT NULL | Nama lengkap mahasiswa |
| tempat | VARCHAR(100) NOT NULL | Tempat lahir mahasiswa |
| tl | VARCHAR(100) NOT NULL | Tanggal lahir mahasiswa |
| gender | VARCHAR(10) NOT NULL | Jenis kelamin mahasiswa |
| email | VARCHAR(100) NOT NULL | Alamat email mahasiswa |
| telp | VARCHAR(100) NOT NULL | Nomor telepon mahasiswa |

### Struktur Direktori
```
├── index.php                # Entry point program
├── model/                   # Komponen Model
│   ├── DB.class.php         # Kelas koneksi database
│   ├── Mahasiswa.class.php  # Representasi objek mahasiswa
│   ├── TabelMahasiswa.class.php # Operasi database untuk tabel mahasiswa
│   └── Template.class.php   # Mesin templating
├── presenter/               # Komponen Presenter
│   ├── KontrakPresenter.php # Interface untuk presenter
│   └── ProsesMahasiswa.php  # Implementasi presenter
├── templates/               # Template HTML
│   ├── skin.html            # Template untuk tampilan utama
│   └── form.html            # Template untuk form tambah/edit
└── view/                    # Komponen View
    ├── KontrakView.php      # Interface untuk view
    └── TampilMahasiswa.php  # Implementasi view
```

# Alur Program

## 1. Inisialisasi Program
- Program dimulai dari `index.php`
- Dilakukan pembuatan objek `TampilMahasiswa` yang bertanggung jawab untuk menampilkan data

## 2. Menampilkan Data Mahasiswa
1. `index.php` memanggil metode `tampil()` pada objek `TampilMahasiswa`
2. `TampilMahasiswa` meminta data dari `ProsesMahasiswa` dengan memanggil `prosesDataMahasiswa()`
3. `ProsesMahasiswa` mengakses database melalui `TabelMahasiswa` untuk mendapatkan data
4. `TampilMahasiswa` menerima data dan merender tampilan menggunakan template `skin.html`
5. Hasil rendering ditampilkan kepada user

## 3. Menambah Data Mahasiswa
1. User mengklik tombol "Tambah Mahasiswa"
2. `index.php` mendeteksi parameter `add` dan memanggil `tampilTambah()` pada `TampilMahasiswa`
3. `TampilMahasiswa` menampilkan form tambah dengan template `form.html`
4. User mengisi form dan mengirimkan data
5. `index.php` mendeteksi POST data dengan parameter `add` dan memanggil `tambahKeDB()`
6. `TampilMahasiswa` meneruskan data ke `ProsesMahasiswa` melalui metode `addData()`
7. `ProsesMahasiswa` memanggil `addMahasiswa()` pada `TabelMahasiswa` untuk menyimpan data ke database
8. User diarahkan kembali ke halaman utama

## 4. Mengedit Data Mahasiswa
1. User mengklik tombol "Edit" pada baris data
2. `index.php` mendeteksi parameter `id_edit` dan memanggil `tampilEdit()` pada `TampilMahasiswa`
3. `TampilMahasiswa` meminta data mahasiswa dari `ProsesMahasiswa` dengan `getMahasiswaById()`
4. Form edit ditampilkan dengan template `form.html` yang diisi dengan data mahasiswa yang ada
5. User mengubah data dan mengirimkan form
6. `index.php` mendeteksi POST data dengan parameter `update` dan memanggil `editKeDB()`
7. `TampilMahasiswa` meneruskan data ke `ProsesMahasiswa` melalui metode `updateData()`
8. Data diperbarui di database
9. User diarahkan kembali ke halaman utama

## 5. Menghapus Data Mahasiswa
1. User mengklik tombol "Hapus" pada baris data
2. Konfirmasi penghapusan ditampilkan kepada pengguna
3. Jika dikonfirmasi, `index.php` mendeteksi parameter `id_hapus` dan memanggil `hapusKeDB()`
4. `TampilMahasiswa` meneruskan ID ke `ProsesMahasiswa` melalui metode `deleteData()`
5. Data dihapus dari database
6. User diarahkan kembali ke halaman utama

# Dokumentasi 

![Deskripsi Gambar](Screenshot/SCREEN-RECORD.gif)
*Halaman Mahasiswa dengan Proses Kelolanya*

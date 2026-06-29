# 🎓 Tugas Besar Sistem Informasi Akademik (SIAKAD)

## 📌 Informasi Proyek

**Nama Proyek** : Sistem Informasi Akademik (SIAKAD)  
**Mata Kuliah** : Pemrograman Web II  
**Program Studi** : Teknik Informatika  
**Semester** : 4 (2025/2026)

---

# 🌐 Link Aplikasi

Proyek ini telah berhasil di-deploy sehingga dapat diakses secara online melalui link berikut:

🔗 **Website:** (https://tubes-siakad-ifb2024-5520124043-mdzikriam-production-ddc5.up.railway.app/)

---

# 📱 Responsive Design

Aplikasi telah dioptimalkan agar dapat digunakan dengan nyaman pada berbagai ukuran layar, baik desktop, tablet, maupun smartphone.

✔ Responsive Layout  
✔ Mobile Friendly  
✔ Tampilan Modern dan User Friendly

---

# 🔑 Akun Demo

Untuk memudahkan pengujian aplikasi, silakan gunakan akun berikut.

## Admin

**Email**
```
admin@siakad.com
```

**Password**
```
password
```

---

## Mahasiswa

**Email**

mhs kelas A
```
dzikri@gmail.com
```

mhs Kelas B
```
abdurahman@gmail.com
```

mhs Kelas C
```
rafil@gmail.com
```

**Password**
```
password
```

---

# 📖 Tentang Aplikasi

Sistem Informasi Akademik (SIAKAD) merupakan aplikasi berbasis web yang dikembangkan untuk membantu pengelolaan data akademik pada sebuah perguruan tinggi.

Melalui aplikasi ini, admin dapat mengelola data dosen, mahasiswa, mata kuliah, jadwal kuliah, serta pengguna. Mahasiswa dapat melakukan pengisian Kartu Rencana Studi (KRS), melihat jadwal perkuliahan, serta mencetak KRS dalam bentuk PDF.

Aplikasi dikembangkan menggunakan framework Laravel dengan konsep CRUD, autentikasi multi-role, dan database relasional sehingga proses administrasi akademik menjadi lebih cepat, mudah, dan efisien.

---
# ✨ Fitur Utama

-Autentikasi dan otorisasi berbasis role (Admin & Mahasiswa) menggunakan Laravel Auth dan middleware.

-CRUD lengkap untuk data Dosen, Mahasiswa, Mata Kuliah, dan Jadwal.

-Perhitungan otomatis jam selesai kuliah berdasarkan jumlah SKS mata kuliah (1 SKS = 50 menit).

-Filter jadwal kuliah sesuai kelas mahasiswa yang login.

-Input dan drop mata kuliah (KRS) oleh mahasiswa, dengan validasi mata kuliah duplikat.

-Admin dapat menghubungkan (assign) akun mahasiswa baru ke data mahasiswa melalui NPM.

-Validasi Laravel pada seluruh form input.

-Eloquent ORM dan relasi antar tabel (Dosen, Mahasiswa, Mata Kuliah, Jadwal, KRS).

# Fitur Tambahan (Bonus)

-Export KRS mahasiswa ke PDF (menggunakan barryvdh/laravel-dompdf).

-Dashboard statistik (total dosen, mahasiswa, mata kuliah, jadwal) untuk admin.

-Tampilan responsif (sidebar overlay untuk mobile, tabel scroll horizontal).

-Loading overlay saat proses pengiriman form.

-Tampilan login dan register dengan toggle show/hide password.

---

# 📑 Penjelasan Menu

## 🏠 Landing Page

Halaman pertama yang ditampilkan ketika pengguna mengakses website. Berisi informasi singkat mengenai aplikasi serta tombol menuju halaman login.

---

## 📊 Dashboard

Halaman utama setelah login yang menampilkan informasi ringkasan data akademik seperti jumlah dosen, mahasiswa, mata kuliah, dan jadwal.

---

## 👨‍🏫 Data Dosen

Menu untuk mengelola data dosen.

Fitur yang tersedia:

- Melihat daftar dosen
- Menambah data dosen
- Mengubah data dosen
- Menghapus data dosen

---

## 👨‍🎓 Data Mahasiswa

Menu untuk mengelola data mahasiswa.

Fitur:

- Menampilkan daftar mahasiswa
- Menambah mahasiswa
- Mengedit data mahasiswa
- Menghapus data mahasiswa
- (admin) dapat menghubungkan akun yang belum tersambung

---

## 📚 Data Mata Kuliah

Digunakan untuk mengelola seluruh mata kuliah yang tersedia.

Informasi yang dikelola meliputi:

- Kode Mata Kuliah
- Nama Mata Kuliah
- Jumlah SKS

---

## 🗓 Data Jadwal

Digunakan untuk menyusun jadwal perkuliahan.

Data yang diatur meliputi:

- Mata Kuliah
- Dosen Pengampu
- Hari
- Jam

---

## 📝 Kartu Rencana Studi (KRS)

Menu khusus mahasiswa untuk mengambil mata kuliah yang akan ditempuh pada semester berjalan.

Fitur:

- Memilih Mata Kuliah
- Menghitung Total SKS
- Melihat Riwayat Pengambilan Mata Kuliah
- Cetak KRS ke PDF

---

# 📸 Dokumentasi Tampilan

Tambahkan screenshot pada folder berikut.

```
screenshots/
│
├── Page-KrsMhs-admin.png
├── Page-dashboard-admin.png
├── Page-dashboard-mahasiswa.png
├── Page-dosen-admin.png
├── Page-jadwal-admin.png
├── Page-jadwal-mahasiswa.png
├── Page-krs-mahasiswa.png
├── Page-mahasiswa-admin.png
├── Page-matakuliah-admin.png
├── form-login.png
└── krs-pdf.png
```

---

# 👨‍💻 Pengembang

**Nama** : Muhammad Dzikri Abdul Muti

**Program Studi** : Teknik Informatika

**Universitas** : SURYAKANCANA

---

# 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan penyelesaian Tugas Besar mata kuliah Pemrograman Web Lanjut.

---

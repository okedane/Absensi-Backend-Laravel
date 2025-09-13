# 🚀 SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN KARYAWAN TERBAIK MENGGUNAKAN METODE MULTI OBJECTIVE OPTIMIZATION ON THE BASIC OF RATION ANALYSIS (MOORA) STUDI KASUS RESTORAN MELITA KITCHEN

Proyek ini adalah Website berbasis **Laravel** untuk pemilihan karyawan terbaik.  
Website ini mencakup fitur seperti dibawah ini.  
Webiste ini juga sebagai backend untuk aplikasi Absensi(link github).

---
### Flow System

## flowchart System
# 🚀 SPK Pemilihan Karyawan Terbaik - Metode MOORA
### Studi Kasus: Restoran Melita Kitchen

## 📝 Deskripsi
Sistem Pendukung Keputusan berbasis Laravel untuk pemilihan karyawan terbaik menggunakan metode Multi Objective Optimization on the Basic of Ratio Analysis (MOORA). Sistem ini terintegrasi dengan aplikasi absensi karyawan.

## 🔄 Arsitektur Sistem

### Flowchart System
![Flowchat sistem](readme/flowchart.png)

### Use Case Diagram
![Usecase Sistem](readme/usecase.png)

### Database Design
<details>
<summary>📊 CDM & PDM</summary>

![CDM](readme/cdm.png)
![PDM](readme/pdm.png)
</details>

## 🖥️ Fitur Utama
- Manajemen Karyawan
- Sistem Absensi
- Pengajuan Izin & Lembur
- Penilaian Karyawan
- Perhitungan MOORA
- Multi-role User System

## 📸 Interface
<details>
<summary>Screenshots Aplikasi</summary>

### Autentikasi
| Login | Reset Password |
|:-------------------------:|:-------------------------:|
|![Login Page](readme/1_login.png)|![Reset Page](readme/2_reset.png)|

### Core Features
| Dashboard | Jabatan | Karyawan |
|:-------------------------:|:-------------------------:|:-------------------------:|
|![Dashboard](readme/3_dashboard.png)|![Jabatan](readme/4_jabatan.png)|![Karyawan](readme/5_karyawan.png)|

### Manajemen Absensi
| Lokasi | Jadwal | History |
|:-------------------------:|:-------------------------:|:-------------------------:|
|![Lokasi](readme/6_lokasi.png)|![Jadwal](readme/7_jadwal.png)|![History](readme/8_history.png)|

### Pengajuan
| Izin | Lembur |
|:-------------------------:|:-------------------------:|
|![Izin](readme/9_izin.png)|![Lembur](readme/10_lembur.png)|

### Penilaian
| Kriteria | Sub Kriteria | Penilaian | Peringkat |
|:-------------------------:|:-------------------------:|:-------------------------:|:-------------------------:|
|![Kriteria](readme/11_kriteria.png)|![SubKriteria](readme/12_subKriteria.png)|![Penilaian](readme/13_penilaian.png)|![Peringkat](readme/14_peringkat.png)|

</details>

## ⚙️ Instalasi

```bash
# Clone repository
git clone [url-repository]

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Migrate database
php artisan migrate:fresh --seed
```

## 🔑 Akses Default
```
Admin Account
Email: romadani.code@gmail.com
Password: 12345678
```

## 📄 License
[MIT License](LICENSE)

## 👨‍💻 Developer
[RomaCode]

<!-- 
## Use Case sistem 
![Usecase Sistem](readme/usecase.png)

## CDM & PDM
![CDM](readme/cdm.png)
![PDM](readme/pdm.png)
## 📸 Tampilan Aplikasi

### 🔑 Halaman Login
![Login Page](readme/1_login.png)

### 🔑 Halaman Reset Password
![Reset Page](readme/2_reset.png)


### 📊 Dashboard
![Dashboard](readme/3_dashboard.png)

### 🏬 Halaman Jabatan
![Halaman Jabatan](readme/4_jabatan.png)

### 🏬 Halaman Karyawan
![Halaman Jabatan](readme/5_karyawan.png)

### 🏬 Halaman Lokasi Resoran
![Halaman Lokasi Restoran](readme/6_lokasi.png)

### 🏬 Halaman Jadwal Absen
![Halaman Jadwal](readme/7_jadwal.png)

### 🏬 Halaman History Absensi
![Halaman History](readme/8_history.png)

### 🏬 Halaman Izin
![Halaman Izin](readme/9_izin.png)

### 🏬 Halaman Lembur
![Halaman Lembur](readme/10_Lembur.png)

### 🏬 Halaman Kriteria
![Halaman kriteria](readme/11_kriteria.png)

### 🏬 Halaman Sub Kriteria
![Halaman SubKriteria](readme/12_subKriteria.png)

### 🏬 Halaman Penilaian
![Halaman Penilaian](readme/13_penilaian.png)

### 🏬 Halaman Peringkat
![Halaman Izin](readme/14_peringkat.png)

### 🏬 Halaman Izin
![Halaman Peringakat](readme/15_izin.png)

### 🏬 Halaman Kelola Akun
![Halaman Kelola Akun](readme/16_akunpng)



## Cara Install Project

1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate
5. php artisan migrate:fresh --seed


## login
admin
email : romadani.code@gmail.com
pw    : 12345678

 -->

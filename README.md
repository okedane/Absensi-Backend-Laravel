# 🚀 SPK Pemilihan Karyawan Terbaik - Metode MOORA
### Studi Kasus: Restoran Melita Kitchen
## 📝 Deskripsi
Sistem Pendukung Keputusan berbasis Laravel untuk pemilihan karyawan terbaik menggunakan metode Multi Objective Optimization on the Basic of Ratio Analysis (MOORA). Sistem ini terintegrasi dengan [aplikasi mobile absensi](https://github.com/okedane/aplikasi-absensi-flutter) untuk memudahkan proses pencatatan kehadiran karyawan.
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
### Penilaian & Perhitungan
| Kriteria | Sub Kriteria | Penilaian |
|:-------------------------:|:-------------------------:|:-------------------------:|
|![Kriteria](readme/11_kriteria.png)|![SubKriteria](readme/12_subKriteria.png)|![Penilaian](readme/13_penilaian.png)|

| Perhitungan | Peringkat |
|:-------------------------:|:-------------------------:|
|![Perhitungan](readme/14_perhitungan.png)|![Peringkat](readme/15_peringkat.png)|

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

## 📄 Data Pendukung
[file Pendukung](readme/skripsi.pdf)

## 👨‍💻 Developer
- Nama: okedane
- GitHub: [RomaCode](https://github.com/okedane)
- Email: romadani.code@gmail.com

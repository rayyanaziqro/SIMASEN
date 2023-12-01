
# Simasen - Presensi Management System

Simasen adalah sebuah sistem manajemen kehadiran yang dirancang khusus untuk keperluan dosen di lingkungan pendidikan. Sistem ini bertujuan untuk mempermudah proses pencatatan dan pemantauan kehadiran dosen dalam berbagai kegiatan di institusi pendidikan.

## Installasi 

Clone Project 

```bash
https://github.com/rayyanaziqro/SIMASEN.git
```

Masuk ke dalam direktori

```bash
composer install
```

Install NPM
```bash
npm install
```

Konfigurasi database anda, jika sudah
```bash
php artisan migrate:fresh --seed 
```


Administrator 
```bash
username : admin123
password : admin
```

Akses ke halaman admin
```bash
localhost:8000/admin 
```


Akses ke halaman dosen
```bash
localhost:8000/dosen
```
Hubungkan public directory dengan storage
```bash
php artisan storage:link
```


    

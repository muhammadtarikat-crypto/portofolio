# Latihan 3 dan 4a — Portofolio dan Setup Laravel

## Identitas Mahasiswa

| Keterangan | Data |
|---|---|
| Nama | Muhammad Tarikat |
| NPM | 24312205 |
| Kelas | IF 24 Cx |
| Branch | `Lat-4a_SetupLaravel` |

## Menjalankan Proyek

Kebutuhan: PHP 8.3+, Composer, Node.js/npm, dan MySQL. Atur kredensial database
lokal di `.env`, lalu jalankan:

```sh
composer install
npm install
php artisan migrate
npm run build
php artisan serve
```

Portofolio dapat dibuka di `http://127.0.0.1:8000`. Halaman bukti setup Latihan
4a tersedia di `/welcome`. Untuk mengembangkan frontend, gunakan `npm run dev`
di terminal terpisah.

> Gunakan `php artisan migrate` pada database yang sudah berisi data.
> `php artisan migrate:fresh --seed` menghapus semua tabel dan hanya boleh
> digunakan pada database latihan kosong.

## Latihan 3 — Landing Page Portofolio

Landing page responsif menggunakan Tailwind CSS 4 dan Vite, dengan navigasi
desktop/mobile, profil, skills, proyek, pengalaman, sertifikat, dan kontak.

**Desktop (1280px):**

![Tampilan portofolio desktop](./public/images/lat-3-desktop.jpg)

**Mobile (375px):**

![Tampilan portofolio mobile](./public/images/lat-3-mobile.jpg)

## Latihan 4a — Setup Laravel

Halaman `/welcome` menampilkan identitas mahasiswa, versi Laravel, nama
database yang dikonfigurasi, dan status koneksi database aktual. Beranda
portofolio tetap berada di `/`.

Informasi lingkungan proyek: PHP 8.3.33, Laravel 13.37.0, MySQL, database
`portofolio`. Database aktif dipertahankan dan tidak diganti ke
`portofolio_web`.

**Bukti halaman setup:**

![Identitas dan status database pada halaman setup](./public/images/lat-4a-setup.jpg)

### Struktur Folder Utama

| Folder | Kegunaan |
|---|---|
| `app/Models` | Model Eloquent |
| `app/Http/Controllers` | Controller aplikasi |
| `routes` | Route web dan API |
| `resources/views` | Tampilan Blade |
| `resources/css`, `resources/js` | Aset frontend |
| `database/migrations` | Skema database |
| `database/seeders` | Data awal |
| `public` | Aset publik |

### Perintah Artisan

```sh
php artisan --version
php artisan route:list
php artisan migrate:status
php artisan make:model NamaModel -m
```

## Latihan Berikutnya

Latihan 4b tersedia pada branch
[Lat-4b_DatabaseModel](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-4b_DatabaseModel).
Latihan 5a tersedia pada branch
[Lat-5a_RestAPI_GET](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-5a_RestAPI_GET).

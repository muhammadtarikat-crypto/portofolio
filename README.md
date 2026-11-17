# Latihan 2 — Website Portfolio dengan FrontEnd Framework Tailwind

## Identitas Mahasiswa

| Keterangan | Data |
|---|---|
| Nama | Muhammad Tarikat |
| NPM | 24312205 |
| Kelas | IF 24 Cx |
| Branch | `Lat2_Tailwind` |

## Deskripsi

Tugas ini melanjutkan website portfolio dari Latihan 1 dengan menerapkan
Tailwind CSS sebagai framework frontend. Project menggunakan Laravel Blade
untuk struktur halaman dan Tailwind CSS v4 melalui Vite untuk styling.

## Menjalankan Proyek

Pastikan PHP, Composer, Node.js/npm, dan MySQL tersedia. Salin `.env.example`
menjadi `.env`, siapkan database lokal, lalu atur koneksi `DB_*` di `.env`.
Dari root project, jalankan:

```sh
composer install
php artisan key:generate
npm install
php artisan migrate
npm run build
php artisan db:seed
php artisan serve
```

Buka `http://127.0.0.1:8000`. Untuk pengembangan frontend dengan reload
otomatis, jalankan `npm run dev` di terminal terpisah.

Data portfolio pada halaman dimuat melalui API dan database. Seeder mengisi
data contoh. Jangan gunakan `php artisan migrate:fresh --seed` pada database
yang berisi data penting karena perintah tersebut menghapus semua tabel.

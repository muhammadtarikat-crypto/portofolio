# Latihan 5a — REST API GET Portofolio

## Identitas Mahasiswa

| Keterangan | Data |
|---|---|
| Nama | Muhammad Tarikat |
| NPM | 24312205 |
| Kelas | IF 24 Cx |
| Branch | `Lat-5a_RestAPI_GET` |

## Tujuan

Menyediakan REST API read-only untuk mengambil profil, skill, proyek,
pengalaman, dan sertifikat portofolio. Data dikirim dalam format JSON melalui
Laravel API.

## Menjalankan Aplikasi

Kebutuhan: PHP 8.3+, Composer, Node.js/npm, dan MySQL. Atur koneksi database
lokal pada `.env`, lalu jalankan:

```sh
composer install
npm install
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Server berjalan di `http://127.0.0.1:8000`. Endpoint dapat diuji dengan browser,
curl, atau Postman. `php artisan db:seed` memasukkan data contoh portofolio.
Gunakan hanya pada database latihan; jangan jalankan `migrate:fresh` pada
database yang memiliki data penting karena perintah itu menghapus semua tabel.

## Endpoint GET

| Method | Endpoint | Kegunaan |
|---|---|---|
| GET | `/api/portfolio/profile` | Mengambil profil |
| GET | `/api/portfolio/skills` | Mengambil daftar skill berdasarkan urutan |
| GET | `/api/portfolio/projects` | Mengambil daftar proyek berdasarkan urutan |
| GET | `/api/portfolio/projects/{slug}` | Mengambil detail proyek berdasarkan slug |
| GET | `/api/portfolio/experiences` | Mengambil pendidikan dan pengalaman |
| GET | `/api/portfolio/certificates` | Mengambil daftar sertifikat |

Respons sukses menggunakan struktur JSON dengan `status`, `message`, dan
`data`. Respons daftar juga menyertakan `total`. Jika profil atau proyek tidak
ditemukan, API mengembalikan status 404 dengan `status: error` dan `data: null`.

Contoh permintaan:

```sh
curl http://127.0.0.1:8000/api/portfolio/projects
curl http://127.0.0.1:8000/api/portfolio/projects/nusantara-journey
```

## Pengujian API

Jalankan seluruh tes fitur API:

```sh
php artisan test --compact tests/Feature/PortfolioApiTest.php
```

Tes mencakup respons profil, skills dan proyek yang terurut, slug detail
proyek, respons 404, pengalaman, sertifikat, serta tautan endpoint di halaman
utama.

## Koleksi Postman dan Bukti

Impor koleksi [Lat-5a_Portfolio_API.postman_collection.json](./Lat-5a_Portfolio_API.postman_collection.json)
ke Postman untuk menjalankan permintaan API.

![Bukti status API Latihan 5a](./public/images/lat-5a-api-status.jpg)

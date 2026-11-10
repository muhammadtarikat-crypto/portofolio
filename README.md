# Portofolio — Latihan 3, 4a, 4b, dan 5a

Portofolio responsif Muhammad Tarikat menggunakan Laravel, MySQL, dan REST API.
Branch `main` menggabungkan hasil latihan; README tiap branch latihan tetap
berisi dokumentasi khusus untuk latihan tersebut.

## Identitas Mahasiswa

| Keterangan | Data |
|---|---|
| Nama | Muhammad Tarikat |
| NPM | 24312205 |
| Kelas | IF 24 Cx |

## Hasil Latihan

### Latihan 3 — Landing Page

Landing page portofolio responsif dengan bagian profil, skills, proyek,
pengalaman, sertifikat, kontak, dan pilihan tema.

![Tampilan desktop Latihan 3](./public/images/lat-3-desktop.jpg)

![Tampilan mobile Latihan 3](./public/images/lat-3-mobile.jpg)

### Latihan 4a — Setup Laravel

Halaman `/welcome` menampilkan identitas mahasiswa, versi Laravel, nama
database, dan status koneksi. Bukti setup:

![Bukti setup Latihan 4a](./public/images/lat-4a-setup.jpg)

### Latihan 4b — Database dan Model

Database menggunakan tabel profil, skills, projects, pengalaman, sertifikat,
serta tabel pivot `project_skill` dan tabel `messages`. Relasi Project–Skill
adalah many-to-many; `ProjectSkillSeeder` mengisi relasi tanpa membuat ulang
data proyek.

![Hasil query relasi project dan skills](./public/images/lat-4b-database-relations.png)

![Struktur tabel messages](./public/images/lat-4b-messages-table.png)

Screenshot `messages` yang tersedia hanya memperlihatkan sebagian kolom.
Verifikasi Tinker dapat dijalankan dengan:

```sh
php artisan tinker --execute 'dump(App\Models\Project::find(1)->skills->first()->name);'
```

### Latihan 5a — REST API GET

Endpoint GET tersedia untuk profil, skills, projects, detail project
berdasarkan slug, experiences, dan certificates:

| Endpoint | Kegunaan |
|---|---|
| `/api/portfolio/profile` | Profil |
| `/api/portfolio/skills` | Daftar skills |
| `/api/portfolio/projects` | Daftar projects |
| `/api/portfolio/projects/{slug}` | Detail project |
| `/api/portfolio/experiences` | Pengalaman dan pendidikan |
| `/api/portfolio/certificates` | Sertifikat |

Koleksi Postman tersedia di
[Lat-5a_Portfolio_API.postman_collection.json](./Lat-5a_Portfolio_API.postman_collection.json).

![Bukti status API Latihan 5a](./public/images/lat-5a-api-status.jpg)

## Menjalankan Aplikasi

Kebutuhan: PHP 8.3+, Composer, Node.js/npm, dan MySQL. Atur kredensial database
lokal pada `.env`, lalu jalankan:

```sh
composer install
npm install
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Seeder memasukkan data contoh portofolio. Jalankan pada database latihan yang
sesuai; jangan jalankan `php artisan migrate:fresh --seed` pada database yang
menyimpan data penting karena perintah itu menghapus seluruh tabel.

## Pengujian

Jalankan semua tes:

```sh
php artisan test --compact
```

Dokumentasi khusus tiap latihan:

- [Latihan 3](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-3_LandingPage)
- [Latihan 4a](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-4a_SetupLaravel)
- [Latihan 4b](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-4b_DatabaseModel)
- [Latihan 5a](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-5a_RestAPI_GET)

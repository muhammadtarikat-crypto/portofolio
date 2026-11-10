# Portofolio Muhammad Tarikat

Portofolio pribadi berbasis Laravel yang menampilkan profil, keahlian, proyek,
pengalaman, sertifikat, dan formulir kontak.

## Identitas Mahasiswa

| Keterangan | Data |
|---|---|
| Nama | Muhammad Tarikat |
| NPM | 24312205 |
| Kelas | IF 24 Cx |
| Framework | Laravel 13.37.0 |
| Database aktif | MySQL — `portofolio` |

## Menjalankan Proyek

Kebutuhan: PHP 8.3+, Composer, Node.js/npm, dan MySQL.

```sh
composer install
npm install
```

Salin `.env.example` menjadi `.env`, sesuaikan koneksi database lokal, lalu
jalankan:

```sh
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000`. Untuk menjalankan frontend selama pengembangan,
gunakan `npm run dev` di terminal terpisah.

> **Penting:** `php artisan migrate:fresh --seed` menghapus semua tabel sebelum
> membuatnya kembali. Jangan jalankan pada database yang berisi data penting.
> Untuk database proyek yang sudah ada, gunakan `php artisan migrate`.

## Latihan dan Branch Pengumpulan

Pekerjaan setiap latihan tersedia pada branch GitHub berikut:

| Latihan | Branch |
|---|---|
| 3 — Landing Page | [Lat-3_LandingPage](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-3_LandingPage) |
| 4a — Setup Laravel | [Lat-4a_SetupLaravel](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-4a_SetupLaravel) |
| 4b — Database dan Model | [Lat-4b_DatabaseModel](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-4b_DatabaseModel) |
| 5a — REST API GET | [Lat-5a_RestAPI_GET](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-5a_RestAPI_GET) |

### Latihan 3 — Landing Page

Landing page portofolio responsif menggunakan Tailwind CSS 4 dan Vite. Halaman
memuat navigasi desktop/mobile, hero, skills, proyek, pengalaman, sertifikat,
formulir kontak, dan footer.

**Bukti tampilan desktop (1280px):**

![Landing page portofolio pada desktop](./public/images/lat-3-desktop.jpg)

**Bukti tampilan mobile (375px):**

![Landing page portofolio pada mobile](./public/images/lat-3-mobile.jpg)

### Latihan 4a — Setup Laravel

Halaman bukti identitas dan konfigurasi tersedia di `/welcome`; halaman utama
portofolio tetap berada di `/`. Halaman menampilkan nama, NPM, kelas, versi
Laravel, database yang dikonfigurasi, dan status koneksi aktual.

Versi yang terpasang di lingkungan proyek: PHP 8.3.33, Laravel 13.37.0, MySQL,
dan database `portofolio`. Versi/nama database ini mencerminkan konfigurasi
proyek yang ada; aplikasi tidak diturunkan versinya dan database tidak diganti
ke `portofolio_web`.

**Bukti halaman setup:**

![Halaman setup Laravel](./public/images/lat-4a-setup.jpg)

**Struktur folder utama:**

| Folder | Isi |
|---|---|
| `app/Models` | Model Eloquent |
| `app/Http/Controllers` | Controller aplikasi dan API |
| `routes` | Route web dan API |
| `resources/views` | Tampilan Blade |
| `resources/css`, `resources/js` | Aset frontend |
| `database/migrations` | Definisi skema database |
| `database/seeders` | Data awal dan relasi demo |
| `public` | Aset publik dan bukti screenshot |

**Perintah Artisan yang digunakan:**

```sh
php artisan --version
php artisan route:list
php artisan migrate:status
php artisan make:model NamaModel -m
```

### Latihan 4b — Database dan Model

Latihan ini berfokus pada database dan model. Bukti screenshot website desktop
tidak diperlukan untuk bagian 4b; screenshot tampilan website ada pada bagian
Latihan 3.

Migrasi menambahkan tabel pivot `project_skill` serta tabel `messages`.
`Project::skills()` dan `Skill::projects()` menyediakan relasi many-to-many
dua arah. Endpoint `POST /api/contacts` tetap kompatibel, tetapi pesan baru
disimpan ke `messages`. Tabel lama `contacts` dipertahankan agar data dan
integrasi yang sudah ada tidak dihapus.

**Tujuh tabel inti:**

| Tabel | Kegunaan |
|---|---|
| `profiles` | Biodata dan tautan portofolio |
| `skills` | Keahlian, kategori, ikon, dan urutan |
| `projects` | Data proyek dan tag |
| `project_skill` | Relasi project-skill dengan foreign key |
| `experiences` | Pendidikan/pengalaman dan detail |
| `certificates` | Sertifikat, penerbit, dan tahun |
| `messages` | Pesan formulir kontak |

Seeder `ProjectSkillSeeder` menghubungkan proyek dengan keahlian yang sesuai.
Seeder ini bisa dijalankan pada data yang sudah ada tanpa membuat ulang profil
atau proyek:

```sh
php artisan db:seed --class=ProjectSkillSeeder
```

Pada database aktif `portofolio`, migrasi sudah diterapkan dan relasi berikut
telah diverifikasi:

| Proyek | Skills |
|---|---|
| Nusantara Journey | Flutter, Figma |
| EcoHero | Figma |
| CleanCity | Figma |
| Website Portofolio | Laravel, MySQL, Tailwind CSS |

Query baca-saja untuk menampilkan relasi:

```sql
SELECT p.title,
       GROUP_CONCAT(s.name ORDER BY s.name SEPARATOR ', ') AS skills
FROM projects p
JOIN project_skill ps ON ps.project_id = p.id
JOIN skills s ON s.id = ps.skill_id
GROUP BY p.id, p.title
ORDER BY p.sort, p.id;
```

Contoh pemeriksaan relasi dengan Tinker:

```sh
php artisan tinker --execute 'dump(App\Models\Project::find(1)->skills->first()->name);'
```

Hasil pada database aktif: `"Flutter"`. Untuk melihat status migrasi:

```sh
php artisan migrate:status
```

Screenshot berikut menunjukkan database, tabel `project_skill`, query, dan
hasil relasi.

![Bukti HeidiSQL relasi project dan skills](./public/images/lat-4b-database-relations.png)

Screenshot struktur tabel `messages` dari HeidiSQL:

![Struktur tabel messages di HeidiSQL](./public/images/lat-4b-messages-table.png)

**Catatan bukti:** screenshot `messages` yang tersedia hanya menampilkan bagian
atas daftar kolom. Jika dosen meminta semua kolom terlihat, ambil screenshot
tambahan setelah menggulir daftar kolom ke bawah. Hasil verifikasi Tinker
`"Flutter"` tercatat di atas, tetapi screenshot terminal Tinker belum tersedia.

### Latihan 5a — REST API GET

Latihan 5a dikerjakan pada branch tersendiri, yaitu
[Lat-5a_RestAPI_GET](https://github.com/muhammadtarikat-crypto/portofolio/tree/Lat-5a_RestAPI_GET).
Branch tersebut menyediakan endpoint berikut:

| Method | Endpoint | Kegunaan |
|---|---|---|
| GET | `/api/portfolio/profile` | Data profil |
| GET | `/api/portfolio/skills` | Daftar keahlian |
| GET | `/api/portfolio/projects` | Daftar proyek |
| GET | `/api/portfolio/projects/{slug}` | Detail proyek |
| GET | `/api/portfolio/experiences` | Pendidikan dan pengalaman |
| GET | `/api/portfolio/certificates` | Sertifikat |

Respons API memakai envelope JSON dengan `status`, `message`, dan `data`.
Dokumentasi lengkap, tes endpoint, serta koleksi Postman tersedia pada branch
tersebut: [README Latihan 5a](https://github.com/muhammadtarikat-crypto/portofolio/blob/Lat-5a_RestAPI_GET/README.md) dan
[koleksi Postman](https://github.com/muhammadtarikat-crypto/portofolio/blob/Lat-5a_RestAPI_GET/Lat-5a_Portfolio_API.postman_collection.json).

## Pengujian

Jalankan seluruh tes:

```sh
php artisan test --compact
```

Tes mencakup halaman setup, relasi project-skill, serta penyimpanan dan validasi
pesan kontak. Database tes memakai SQLite terisolasi.

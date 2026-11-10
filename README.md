<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Latihan 3 — Landing Page Portofolio

Branch pengumpulan: `Lat-3_LandingPage`.

Portofolio ini memakai Tailwind CSS 4 melalui Vite. Halaman memuat navigasi
responsif dengan menu hamburger, hero, skills, proyek, timeline pengalaman,
sertifikat, formulir kontak, dan footer. Untuk menjalankan secara lokal:

```sh
npm install
npm run build
php artisan serve
```

### Bukti Tampilan

**Desktop (1280px)**

![Tampilan portofolio desktop](./public/images/lat-3-desktop.jpg)

**Mobile (375px)**

![Tampilan portofolio mobile](./public/images/lat-3-mobile.jpg)

## Latihan 4a — Setup Laravel

Branch pengumpulan: `Lat-4a_SetupLaravel`.

Halaman bukti setup tersedia di `/welcome`; beranda portofolio tetap berada di `/`.
Halaman menampilkan identitas mahasiswa, versi Laravel, nama database yang
dikonfigurasi, dan status koneksinya. Lingkungan proyek saat ini memakai PHP
8.3.33, Laravel 13.37.0, MySQL, dan database `portofolio` (dipertahankan dari
konfigurasi yang sudah ada).

### Struktur Folder Utama

- `app/` — model dan logika aplikasi.
- `routes/` — definisi route web dan API.
- `resources/views/` — tampilan Blade.
- `resources/css/` dan `resources/js/` — aset frontend.
- `database/migrations/` dan `database/seeders/` — skema dan data awal.
- `public/` — aset yang dapat diakses browser.

### Perintah Artisan

```sh
php artisan --version
php artisan route:list
php artisan migrate:status
php artisan make:model NamaModel -m
```

### Bukti Tampilan

![Halaman setup Laravel](./public/images/lat-4a-setup.jpg)

## Latihan 4b — Database dan Model

Branch pengumpulan: `Lat-4b_DatabaseModel`.

Migrasi tambahan membuat pivot `project_skill` dengan foreign key ke `projects`
dan `skills`, serta tabel `messages` untuk formulir kontak. Model `Project` dan
`Skill` memiliki relasi many-to-many dua arah. Endpoint lama `/api/contacts`
dipertahankan, tetapi pesan baru disimpan ke `messages`. Tabel `contacts` tetap
ada sebagai tabel lama agar perubahan ini tidak menghapus data atau merusak
integrasi yang sudah ada.

### Tujuh Tabel Inti

| Tabel | Kolom utama / relasi |
|---|---|
| `profiles` | Biodata utama dan tautan portofolio |
| `skills` | Nama, kategori, ikon, dan urutan skill |
| `projects` | Informasi proyek dan tag JSON yang sudah digunakan API |
| `project_skill` | `project_id` → `projects.id`, `skill_id` → `skills.id` |
| `experiences` | Pendidikan/pengalaman dan detail JSON |
| `certificates` | Nama sertifikat, penerbit, tahun, dan urutan |
| `messages` | Nama, email, subjek, isi pesan, dan timestamps |

Seeder menghubungkan proyek dengan skill terkait dan membuat satu pesan demo
di domain contoh `.test`. Tes berjalan pada SQLite terisolasi; seeder tidak
dijalankan terhadap database aktif yang sudah berisi data.

```sh
php artisan migrate
php artisan migrate:status
php artisan test --compact
```

Untuk menambahkan relasi project-skill ke data yang sudah ada tanpa
menduplikasikan profil/proyek, jalankan seeder khusus yang aman diulang:

```sh
php artisan db:seed --class=ProjectSkillSeeder
```

`php artisan migrate:fresh --seed` menghapus semua tabel terlebih dahulu;
jalankan hanya pada database latihan kosong, bukan database `portofolio` yang
sudah berisi data.

### Verifikasi Database Aktif

Migrasi baru sudah berjalan pada MySQL `portofolio`. Relasi yang ditambahkan ke
data proyek yang sudah ada:

| Proyek | Skill terkait |
|---|---|
| Nusantara Journey | Flutter, Figma |
| EcoHero | Figma |
| CleanCity | Figma |
| Website Portofolio | Laravel, MySQL, Tailwind CSS |

Tabel `messages` sudah tersedia dan belum diisi pesan contoh pada database
aktif. Pesan demo hanya dibuat oleh `DatabaseSeeder` pada database latihan
kosong. Untuk mengecek relasi dengan Tinker:

```sh
php artisan tinker --execute 'dump(App\Models\Project::find(1)->skills->first()->name);'
```

Output pada database aktif: `"Flutter"`. Bukti skema dan isi relasi di atas
diambil dari database MySQL yang terhubung, tanpa menjalankan reset tabel.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Jalankan: php artisan migrate:fresh --seed
    // GANTI data bertanda [ ... ] dan link usernameanda dengan data asli Anda.
    public function run(): void
    {
        Profile::create([
            'name'      => 'Muhammad Tarikat',
            'headline'  => 'Informatics Student | Programmer, Mobile App Developer & UI/UX Designer',
            'bio'       => 'Mahasiswa Teknik Informatika di Universitas Teknokrat Indonesia yang tertarik pada pemrograman, aplikasi mobile, UI/UX, dan desain grafis. Saya ingin menjadi full-stack developer yang membuat solusi digital kreatif dan bermanfaat.',
            'photo'     => 'images/Foto_tarikat.jpg',
            'email'     => 'muhammad.tarikat@gmail.com',
            'github'    => 'https://github.com/usernameanda',
            'linkedin'  => 'https://linkedin.com/in/usernameanda',
            'instagram' => 'https://www.instagram.com/tarikattt_/',
            'cv_url'    => 'cv/CV-Muhammad-Tarikat.pdf',
        ]);

        $icon = fn (string $n) => "https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/icons/$n/$n-original.svg";
        $skills = [
            ['HTML5', 'Frontend', 'html5'], ['CSS3', 'Frontend', 'css3'],
            ['Tailwind CSS', 'Frontend', 'tailwindcss'], ['JavaScript', 'Frontend', 'javascript'],
            ['PHP', 'Backend & Database', 'php'], ['Laravel', 'Backend & Database', 'laravel'],
            ['MySQL', 'Backend & Database', 'mysql'], ['Flutter', 'Backend & Database', 'flutter'],
            ['Git', 'Tools', 'git'], ['GitHub', 'Tools', 'github'], ['VS Code', 'Tools', 'vscode'],
            ['Figma', 'Tools', 'figma'], ['Postman', 'Tools', 'postman'],
        ];
        foreach ($skills as $i => [$name, $cat, $slug]) {
            Skill::create(['name' => $name, 'category' => $cat, 'icon' => $icon($slug), 'sort' => $i]);
        }

        $projects = [
            ['Nusantara Journey', 'mobile', 'Aplikasi mobile pariwisata desa untuk menemukan destinasi, melihat paket wisata, memesan, dan merencanakan perjalanan.', 'images/project-nusantara-journey.svg', ['Flutter', 'Figma']],
            ['EcoHero', 'design', 'Konsep game bertema lingkungan yang memadukan aksi, strategi, dan edukasi pembangunan berkelanjutan.', 'images/project-ecohero.svg', ['GameDesign', 'UIDesign']],
            ['CleanCity', 'design', 'Konsep aplikasi edukasi dan pelaporan lokasi sampah untuk meningkatkan kesadaran pengelolaan sampah.', 'images/project-cleancity.svg', ['UIUX', 'Figma']],
            ['Website Portofolio', 'web', 'Website portofolio pribadi responsif dengan dark mode. Data dimuat dari REST API Laravel dan MySQL.', 'images/project-portfolio-web.svg', ['Laravel', 'Tailwind', 'MySQL']],
        ];
        foreach ($projects as $i => [$title, $cat, $desc, $img, $tags]) {
            Project::create(['title' => $title, 'category' => $cat, 'description' => $desc, 'image' => $img, 'tags' => $tags, 'demo_url' => '#', 'repo_url' => '#', 'sort' => $i]);
        }

        Experience::create(['type' => 'education', 'title' => 'Mahasiswa Teknik Informatika', 'institution' => 'Universitas Teknokrat Indonesia', 'period' => '2024 – Sekarang', 'details' => ['Mempelajari pemrograman web, mobile, dan basis data.', 'Mengerjakan proyek UI/UX dan pengembangan aplikasi.'], 'sort' => 0]);
        Experience::create(['type' => 'education', 'title' => 'Siswa SMA Jurusan IPS', 'institution' => 'SMA 1 Bandar Lampung', 'period' => '2021 – 2024', 'details' => null, 'sort' => 1]);
        Experience::create(['type' => 'experience', 'title' => '[Posisi, mis. Anggota Divisi ...]', 'institution' => '[Organisasi / Magang / Freelance / Kepanitiaan]', 'period' => '[Periode]', 'details' => ['[Tugas atau peran utama]', '[Pencapaian]'], 'sort' => 2]);

        Certificate::create(['name' => '[Nama sertifikat 1]', 'issuer' => '[Penerbit, mis. Dicoding]', 'year' => '[Tahun]', 'sort' => 0]);
        Certificate::create(['name' => '[Nama sertifikat 2]', 'issuer' => '[Penerbit, mis. Coursera]', 'year' => '[Tahun]', 'sort' => 1]);
    }
}

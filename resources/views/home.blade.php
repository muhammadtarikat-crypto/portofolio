<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Muhammad Tarikat | Portfolio</title>
<script>
  // Terapkan tema tersimpan sebelum halaman tampil (mencegah kedip)
  if (localStorage.theme === 'dark' || (!('theme' in localStorage) && matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
  }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
{{-- Tailwind CSS dibangun oleh Vite (jalankan: npm run dev) --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased transition-colors">

@php
  $navs = ['Home' => '#home', 'About' => '#about', 'Skills' => '#skills', 'Projects' => '#projects', 'Experience' => '#experience', 'Certificates' => '#certificates', 'Contact' => '#contact'];
  $input = 'w-full rounded-lg border border-slate-300 dark:border-white/20 bg-slate-50 dark:bg-slate-900 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600 dark:focus:ring-cyan-400';
  $link = 'hover:text-blue-600 dark:hover:text-cyan-400';
@endphp

<!-- ============ NAVBAR ============ -->
<header class="site-header fixed top-0 inset-x-0 z-50 bg-white/90 dark:bg-slate-950/90 backdrop-blur border-b border-slate-200 dark:border-white/10">
  <div class="max-w-6xl mx-auto px-5 h-[4.5rem] flex items-center justify-between">
    <a href="#home" id="brandName" class="brand-mark font-extrabold text-lg">Muhammad Tarikat</a>
    <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-600 dark:text-slate-300">
      @foreach ($navs as $label => $href)
        <a href="{{ $href }}" class="nav-link {{ $link }}">{{ $label }}</a>
      @endforeach
    </nav>
    <div class="flex items-center gap-2">
      <button id="themeBtn" aria-label="Ganti tema" class="w-10 h-10 rounded-lg border border-slate-300 dark:border-white/20 hover:bg-slate-100 dark:hover:bg-white/10">
        <i class="fa-solid fa-moon dark:hidden"></i><i class="fa-solid fa-sun hidden dark:inline"></i>
      </button>
      <button id="menuBtn" aria-label="Buka menu" aria-expanded="false" aria-controls="mobileMenu" class="md:hidden w-10 h-10 rounded-lg border border-slate-300 dark:border-white/20"><i class="fa-solid fa-bars"></i></button>
    </div>
  </div>
  <nav id="mobileMenu" class="hidden md:hidden border-t border-slate-200 dark:border-white/10 px-5 py-3 flex-col text-sm font-medium">
    @foreach ($navs as $label => $href)
      <a href="{{ $href }}" class="py-2">{{ $label }}</a>
    @endforeach
  </nav>
</header>

<main class="pt-[4.5rem]">

  <!-- Pesan jika API gagal dimuat -->
  <div id="apiError" class="hidden bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-200 text-center text-sm px-5 py-3">
    Data gagal dimuat dari API. Pastikan MySQL menyala, sudah menjalankan <code>php artisan migrate:fresh --seed</code>, dan server <code>php artisan serve</code> aktif.
  </div>

  <!-- ============ HERO (data dari /api/profile) ============ -->
  <section id="home" class="hero-section relative isolate overflow-hidden py-16 md:py-24">
    <div class="hero-orb hero-orb-one" aria-hidden="true"></div>
    <div class="hero-orb hero-orb-two" aria-hidden="true"></div>
    <div class="max-w-6xl mx-auto px-5 grid md:grid-cols-[1.15fr_.85fr] gap-12 lg:gap-20 items-center">
      <div class="order-2 md:order-1 text-center md:text-left">
        <p class="eyebrow mx-auto md:mx-0"><span class="eyebrow-dot"></span> PORTOFOLIO • INFORMATIKA</p>
        <p class="mt-8 text-blue-700 dark:text-cyan-300 font-semibold">Halo, saya</p>
        <h1 id="pName" class="hero-title mt-2 text-4xl sm:text-5xl lg:text-6xl font-extrabold">Muhammad Tarikat</h1>
        <p id="pHeadline" class="text-lg sm:text-xl text-slate-600 dark:text-slate-300 mt-5">Memuat data...</p>
        <p id="pBio" class="text-slate-600 dark:text-slate-400 max-w-xl mt-4 mx-auto md:mx-0 leading-7"></p>
        <div class="mt-8 flex flex-wrap gap-3 justify-center md:justify-start">
          <a id="pCv" href="#" download class="button-primary px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 active:scale-95 transition"><i class="fa-solid fa-download mr-2"></i>Download CV</a>
          <a href="#projects" class="button-secondary px-6 py-3 rounded-xl border border-slate-300 dark:border-white/20 text-slate-700 dark:text-slate-100 font-semibold hover:border-blue-500 dark:hover:border-cyan-400 active:scale-95 transition">Lihat Proyek <i class="fa-solid fa-arrow-down ml-2 text-xs"></i></a>
        </div>
        <div class="mt-8 flex gap-3 justify-center md:justify-start">
          <a data-social="github" href="#" aria-label="GitHub" class="social-link {{ $link }}"><i class="fa-brands fa-github"></i></a>
          <a data-social="linkedin" href="#" aria-label="LinkedIn" class="social-link {{ $link }}"><i class="fa-brands fa-linkedin"></i></a>
          <a data-social="instagram" href="#" aria-label="Instagram" class="social-link {{ $link }}"><i class="fa-brands fa-instagram"></i></a>
          <a data-social="email" href="#" aria-label="Email" class="social-link {{ $link }}"><i class="fa-solid fa-envelope"></i></a>
        </div>
      </div>
      <div class="order-1 md:order-2 profile-visual mx-auto">
        <div class="profile-frame">
          <div class="profile-frame-inner">
            <img id="pPhoto" src="/images/Foto_tarikat.jpg" alt="Foto Muhammad Tarikat" class="profile-photo w-48 h-48 sm:w-56 sm:h-56 lg:w-72 lg:h-72 rounded-full object-cover object-top">
          </div>
          <span class="profile-spark profile-spark-one" aria-hidden="true"><i class="fa-solid fa-code"></i></span>
          <span class="profile-spark profile-spark-two" aria-hidden="true"><i class="fa-solid fa-pen-nib"></i></span>
        </div>
        <div class="profile-caption"><span class="caption-icon"><i class="fa-solid fa-layer-group"></i></span><span><strong>Digital creator</strong><small>Web • Mobile • UI/UX</small></span></div>
      </div>
    </div>
    <a href="#about" class="scroll-hint hidden md:flex" aria-label="Gulir ke bagian tentang saya"><span></span> GULIR UNTUK MENJELAJAH</a>
  </section>

  <!-- ============ ABOUT & SKILLS (data dari /api/skills) ============ -->
  <section id="about" class="content-section py-20 md:py-24 bg-white dark:bg-slate-900/50 border-y border-slate-200 dark:border-white/10">
    <div class="max-w-6xl mx-auto px-5">
      <div class="section-heading">
        <p class="section-kicker">KENALI SAYA</p>
        <h2 class="section-title">Tentang Saya<span>.</span></h2>
        <p class="text-slate-600 dark:text-slate-400 max-w-3xl mt-4 leading-7">
          Saya Muhammad Tarikat, mahasiswa Teknik Informatika yang menyukai dunia pengembangan produk digital. Saya terus belajar membangun aplikasi web dan mobile serta merancang antarmuka yang nyaman digunakan. Tujuan karier saya adalah menjadi full-stack developer.
        </p>
      </div>
      <div class="skills-heading"><h3 class="text-xl font-bold">Peralatan yang saya gunakan</h3><span>Keahlian</span></div>
      <div id="skills" class="grid md:grid-cols-3 gap-5"></div>
    </div>
  </section>

  <!-- ============ PROJECTS (data dari /api/projects) ============ -->
  <section id="projects" class="content-section py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-5">
      <div class="section-heading flex flex-col md:flex-row md:items-end md:justify-between gap-5">
        <div><p class="section-kicker">KARYA TERPILIH</p><h2 class="section-title">Proyek <span>pilihan.</span></h2></div>
        <p class="text-slate-600 dark:text-slate-400 max-w-md leading-7">Eksplorasi ide dan karya digital yang saya bangun dengan rasa ingin tahu dan perhatian pada detail.</p>
      </div>
      <div id="filters" class="flex flex-wrap gap-2 mb-8 text-sm font-semibold"></div>
      <div id="projectGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>
  </section>

  <!-- ============ EXPERIENCE & EDUCATION (data dari /api/experiences) ============ -->
  <section id="experience" class="content-section py-20 md:py-24 bg-white dark:bg-slate-900/50 border-y border-slate-200 dark:border-white/10">
    <div class="max-w-4xl mx-auto px-5">
      <div class="section-heading mb-12"><p class="section-kicker">PERJALANAN</p><h2 class="section-title">Pendidikan &amp; <span>pengalaman.</span></h2></div>
      <ol id="timeline" class="relative border-l-2 border-blue-600 dark:border-cyan-400 ml-3 space-y-10"></ol>
    </div>
  </section>

  <!-- ============ CERTIFICATES (data dari /api/certificates) ============ -->
  <section id="certificates" class="content-section py-20 md:py-24">
    <div class="max-w-6xl mx-auto px-5">
      <div class="section-heading mb-10"><p class="section-kicker">PENCAPAIAN</p><h2 class="section-title">Sertifikat &amp; <span>penghargaan.</span></h2></div>
      <div id="certGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5"></div>
    </div>
  </section>

  <!-- ============ CONTACT (kirim ke POST /api/contacts) ============ -->
  <section id="contact" class="content-section contact-section py-20 md:py-24 bg-white dark:bg-slate-900/50 border-t border-slate-200 dark:border-white/10">
    <div class="max-w-6xl mx-auto px-5 grid md:grid-cols-[.8fr_1.2fr] gap-12 lg:gap-20 items-start">
      <div>
        <p class="section-kicker">ADA IDE MENARIK?</p>
        <h2 class="section-title">Mari buat sesuatu <span>bersama.</span></h2>
        <p class="text-slate-600 dark:text-slate-400 mt-5 leading-7">Punya proyek, kolaborasi, atau sekadar ingin menyapa? Saya senang mendengar kabar dari Anda.</p>
        <a data-social="email" href="#" class="contact-email inline-flex items-center gap-3 mt-7 font-semibold text-blue-700 dark:text-cyan-300"><i class="fa-regular fa-envelope"></i><span>Kirim email kepada saya</span><i class="fa-solid fa-arrow-right text-xs"></i></a>
      </div>
      <form id="contactForm" novalidate class="contact-form space-y-4">
        @foreach ([['name', 'Nama Lengkap', 'text', true], ['email', 'Alamat Email', 'email', true], ['subject', 'Subjek', 'text', false], ['message', 'Isi Pesan', 'textarea', true]] as [$id, $label, $type, $required])
          <div>
            <label for="{{ $id }}" class="block text-sm font-semibold mb-1">{{ $label }}</label>
            @if ($type === 'textarea')
              <textarea id="{{ $id }}" name="{{ $id }}" rows="5" class="{{ $input }}" @if ($required) required @endif></textarea>
            @else
              <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}" class="{{ $input }}" @if ($required) required @endif>
            @endif
            <p class="err text-sm text-red-500 mt-1"></p>
          </div>
        @endforeach
        <button type="submit" class="button-primary w-full py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/30 active:scale-95 disabled:opacity-60 transition"><span>Kirim Pesan</span> <i class="fa-solid fa-arrow-right ml-2"></i></button>
        <p id="formStatus" class="text-center font-semibold" role="status"></p>
      </form>
    </div>
  </section>

</main>

<!-- ============ FOOTER ============ -->
<footer class="py-8 border-t border-slate-200 dark:border-white/10">
  <div class="max-w-6xl mx-auto px-5 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-500 dark:text-slate-400">
    <p>&copy; <span id="currentYear"></span> Muhammad Tarikat. Dibuat dengan sepenuh hati.</p>
    <nav class="flex gap-5">
      @foreach (['About' => '#about', 'Projects' => '#projects', 'Experience' => '#experience', 'Contact' => '#contact'] as $label => $href)
        <a href="{{ $href }}" class="{{ $link }}">{{ $label }}</a>
      @endforeach
    </nav>
    <nav aria-label="Media sosial" class="flex gap-4 text-lg">
      <a data-social="github" href="#" aria-label="GitHub" class="{{ $link }}"><i class="fa-brands fa-github"></i></a>
      <a data-social="linkedin" href="#" aria-label="LinkedIn" class="{{ $link }}"><i class="fa-brands fa-linkedin"></i></a>
      <a data-social="email" href="#" aria-label="Email" class="{{ $link }}"><i class="fa-solid fa-envelope"></i></a>
    </nav>
  </div>
</footer>

</body>
</html>

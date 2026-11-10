<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Laravel | Muhammad Tarikat</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 antialiased">
    <main class="mx-auto flex min-h-screen max-w-5xl flex-col justify-center px-5 py-12">
        <a href="/" class="w-fit text-sm font-semibold text-blue-700 hover:text-blue-900 dark:text-cyan-300 dark:hover:text-cyan-200">
            &larr; Kembali ke portofolio
        </a>

        <section class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5 dark:border-white/10 dark:bg-slate-900">
            <div class="bg-gradient-to-r from-blue-700 to-cyan-500 px-6 py-8 text-white sm:px-10">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-100">Latihan 4a</p>
                <h1 class="mt-2 text-3xl font-extrabold sm:text-4xl">Setup Laravel</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-blue-50 sm:text-base">
                    Informasi mahasiswa, versi framework, dan status koneksi database proyek.
                </p>
            </div>

            <div class="grid gap-8 p-6 sm:grid-cols-2 sm:p-10">
                <div>
                    <h2 class="text-lg font-bold">Identitas Mahasiswa</h2>
                    <dl class="mt-5 grid gap-4">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Nama</dt>
                            <dd class="mt-1 text-base font-semibold">Muhammad Tarikat</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">NPM</dt>
                            <dd class="mt-1 text-base font-semibold">24312205</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Kelas</dt>
                            <dd class="mt-1 text-base font-semibold">IF 24 Cx</dd>
                        </div>
                    </dl>
                </div>

                <div class="grid content-start gap-4">
                    <h2 class="text-lg font-bold">Informasi Aplikasi</h2>
                    <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Versi Laravel</p>
                        <p class="mt-1 text-lg font-bold">Laravel {{ $laravelVersion }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Database</p>
                        <p class="mt-1 text-lg font-bold">{{ $databaseName ?: 'Tidak dikonfigurasi' }}</p>
                        <span @class([
                            'mt-3 inline-flex items-center gap-2 rounded-full px-3 py-1 text-sm font-semibold',
                            'bg-emerald-100 text-emerald-800 dark:bg-emerald-400/10 dark:text-emerald-300' => $isDatabaseConnected,
                            'bg-rose-100 text-rose-800 dark:bg-rose-400/10 dark:text-rose-300' => ! $isDatabaseConnected,
                        ]) role="status" aria-live="polite">
                            <span @class([
                                'size-2 rounded-full',
                                'bg-emerald-500' => $isDatabaseConnected,
                                'bg-rose-500' => ! $isDatabaseConnected,
                            ]) aria-hidden="true"></span>
                            {{ $isDatabaseConnected ? 'Tersambung' : 'Tidak tersambung' }}
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

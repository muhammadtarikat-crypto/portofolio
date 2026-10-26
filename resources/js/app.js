/* ===== Helper ===== */
const $ = (s) => document.querySelector(s);
const esc = (s) => String(s ?? '').replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
const getJson = (url) =>
    fetch(url, { headers: { Accept: 'application/json' } }).then((r) => {
        if (!r.ok) throw new Error(url + ' -> ' + r.status);
        return r.json();
    });

const BTN_ON = ['bg-blue-600', 'text-white'];
const BTN_OFF = ['border', 'border-slate-300', 'dark:border-white/20'];

/* ===== Render tiap bagian dari data API ===== */
function renderProfile(p) {
    if (!p) return;
    $('#pName').textContent = p.name;
    $('#pHeadline').textContent = p.headline;
    $('#pBio').textContent = p.bio;
    $('#pPhoto').src = '/' + p.photo;
    $('#pCv').href = '/' + p.cv_url;
    $('#brandName').textContent = p.name;
    document.querySelectorAll('[data-social]').forEach((a) => {
        const k = a.dataset.social;
        a.href = k === 'email' ? 'mailto:' + p.email : p[k] || '#';
    });
}

function renderSkills(list) {
    const groups = {};
    list.forEach((s) => (groups[s.category] ??= []).push(s));
    $('#skills').innerHTML = Object.entries(groups)
        .map(
            ([cat, items]) => `
        <div class="rounded-xl border border-slate-200 dark:border-white/10 p-5 bg-slate-50 dark:bg-slate-900">
          <h4 class="font-semibold text-blue-600 dark:text-cyan-400 mb-4">${esc(cat)}</h4>
          <ul class="grid grid-cols-2 gap-3 text-sm">
            ${items
                .map(
                    (s) => `<li class="flex items-center gap-2"><img class="w-6 h-6 ${/github/.test(s.icon) ? 'dark:invert' : ''}" src="${esc(s.icon)}" alt="">${esc(s.name)}</li>`,
                )
                .join('')}
          </ul>
        </div>`,
        )
        .join('');
}

function renderProjects(list) {
    $('#projectGrid').innerHTML = list
        .map(
            (p) => `
        <article data-cat="${esc(p.category)}" class="project rounded-xl overflow-hidden border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 hover:-translate-y-1 hover:shadow-xl transition">
          <img src="/${esc(p.image)}" alt="${esc(p.title)}" class="w-full aspect-video object-cover">
          <div class="p-5">
            <h3 class="font-bold text-lg">${esc(p.title)}</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">${esc(p.description)}</p>
            <div class="flex flex-wrap gap-2 mt-3 text-xs font-semibold text-blue-700 dark:text-cyan-300">
              ${p.tags.map((t) => `<span class="bg-blue-100 dark:bg-cyan-400/10 px-2 py-1 rounded">#${esc(t)}</span>`).join('')}
            </div>
            <div class="flex gap-3 mt-4 text-sm font-semibold">
              <a href="${esc(p.demo_url || '#')}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Demo</a>
              <a href="${esc(p.repo_url || '#')}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-white/20 hover:bg-slate-100 dark:hover:bg-white/10"><i class="fa-brands fa-github mr-1"></i>GitHub</a>
            </div>
          </div>
        </article>`,
        )
        .join('');

    // Tombol filter dibuat dari kategori yang ada di database
    const cats = ['all', ...new Set(list.map((p) => p.category))];
    $('#filters').innerHTML = cats
        .map(
            (c, i) =>
                `<button data-filter="${esc(c)}" class="filter-btn px-4 py-2 rounded-full capitalize ${i === 0 ? BTN_ON.join(' ') : BTN_OFF.join(' ')}">${c === 'all' ? 'Semua' : esc(c)}</button>`,
        )
        .join('');
    document.querySelectorAll('.filter-btn').forEach((btn) =>
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach((b) => {
                b.classList.remove(...BTN_ON);
                b.classList.add(...BTN_OFF);
            });
            btn.classList.remove(...BTN_OFF);
            btn.classList.add(...BTN_ON);
            const f = btn.dataset.filter;
            document.querySelectorAll('.project').forEach((p) => p.classList.toggle('hidden', f !== 'all' && p.dataset.cat !== f));
        }),
    );
}

function renderTimeline(list) {
    $('#timeline').innerHTML = list
        .map(
            (e) => `
        <li class="ml-6">
          <span class="absolute -left-[9px] w-4 h-4 rounded-full bg-blue-600 dark:bg-cyan-400 ring-4 ring-white dark:ring-slate-950"></span>
          <p class="text-sm font-semibold text-blue-600 dark:text-cyan-400">${esc(e.period)}</p>
          <h3 class="font-bold text-lg">${esc(e.title)}</h3>
          <p class="text-slate-500 dark:text-slate-400">${esc(e.institution)}</p>
          ${e.details ? `<ul class="list-disc ml-5 mt-2 text-sm text-slate-600 dark:text-slate-400">${e.details.map((d) => `<li>${esc(d)}</li>`).join('')}</ul>` : ''}
        </li>`,
        )
        .join('');
}

function renderCertificates(list) {
    $('#certGrid').innerHTML = list
        .map(
            (c) => `
        <div class="flex gap-4 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 p-5 hover:-translate-y-1 hover:shadow-lg transition">
          <i class="fa-solid fa-award text-3xl text-blue-600 dark:text-cyan-400"></i>
          <div><h3 class="font-bold">${esc(c.name)}</h3><p class="text-sm text-slate-500 dark:text-slate-400">${esc(c.issuer)}</p><p class="text-sm font-semibold mt-1">${esc(c.year)}</p></div>
        </div>`,
        )
        .join('');
}

/* ===== Muat semua data dari REST API ===== */
Promise.all(['profile', 'skills', 'projects', 'experiences', 'certificates'].map((n) => getJson('/api/' + n)))
    .then(([profile, skills, projects, experiences, certificates]) => {
        renderProfile(profile.data);
        renderSkills(skills.data);
        renderProjects(projects.data);
        renderTimeline(experiences.data);
        renderCertificates(certificates.data);
    })
    .catch((err) => {
        console.error(err);
        $('#apiError').classList.remove('hidden');
    });

/* ===== Dark mode ===== */
$('#themeBtn').addEventListener('click', () => {
    const dark = document.documentElement.classList.toggle('dark');
    localStorage.theme = dark ? 'dark' : 'light';
});

/* ===== Menu mobile ===== */
const mobileMenu = $('#mobileMenu');
const menuBtn = $('#menuBtn');
const menuIcon = menuBtn.querySelector('i');
const toggleMenu = (open) => {
    mobileMenu.classList.toggle('hidden', !open);
    mobileMenu.classList.toggle('flex', open);
    menuBtn.setAttribute('aria-expanded', String(open));
    menuBtn.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
    menuIcon.classList.toggle('fa-bars', !open);
    menuIcon.classList.toggle('fa-xmark', open);
};
menuBtn.addEventListener('click', () => toggleMenu(mobileMenu.classList.contains('hidden')));
mobileMenu.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => toggleMenu(false)));
$('#currentYear').textContent = new Date().getFullYear();

/* ===== Form kontak: validasi + kirim ke POST /api/contacts ===== */
const form = $('#contactForm');
const status = $('#formStatus');
const rules = [
    ['name', (v) => v.length >= 2, 'Nama minimal 2 karakter.'],
    ['email', (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v), 'Masukkan email yang valid.'],
    ['subject', (v) => v.length >= 3, 'Subjek minimal 3 karakter.'],
    ['message', (v) => v.length >= 10, 'Pesan minimal 10 karakter.'],
];
const setErr = (id, msg) => ($('#' + id).parentElement.querySelector('.err').textContent = msg);

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    status.textContent = '';
    status.className = 'text-center font-semibold';
    let ok = true;
    const body = {};
    rules.forEach(([id, test, msg]) => {
        body[id] = $('#' + id).value.trim();
        const valid = test(body[id]);
        setErr(id, valid ? '' : msg);
        ok = ok && valid;
    });
    if (!ok) return;

    const btn = form.querySelector('button[type=submit]');
    btn.disabled = true;
    try {
        const res = await fetch('/api/contacts', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
            body: JSON.stringify(body),
        });
        const data = await res.json();
        if (res.ok) {
            status.textContent = data.message;
            status.classList.add('text-green-600', 'dark:text-green-400');
            form.reset();
        } else if (res.status === 422) {
            Object.entries(data.errors).forEach(([id, msgs]) => setErr(id, msgs[0]));
        } else {
            throw new Error(res.status);
        }
    } catch {
        status.textContent = 'Pesan gagal dikirim. Coba lagi beberapa saat.';
        status.classList.add('text-red-500');
    } finally {
        btn.disabled = false;
    }
});

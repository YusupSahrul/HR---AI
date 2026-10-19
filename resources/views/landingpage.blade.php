<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gadjihan membantu mengelola penggajian dan absensi dengan lebih mudah.">
    <title>Gadjihan — Penggajian & Absensi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="landing-page">
    <header class="site-header">
        <div class="site-header__inner">
            <a class="brand" href="#beranda" aria-label="Gadjihan beranda">
                <img class="brand__logo" src="{{ asset('assets/LOGO 1.svg') }}" alt="Gadjihan">
            </a>
            <nav class="site-navigation" aria-label="Navigasi utama">
                <a class="site-navigation__link" href="#beranda">Beranda</a>
                <a class="site-navigation__link" href="#fitur">Fitur</a>
                <a class="site-navigation__link" href="#kontak">Kontak</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-section" id="beranda">
            <div class="hero-section__content">
                <p class="section-kicker">Solusi HR untuk bisnis modern</p>
                <h1 class="hero-section__title">Kelola <span>Penggajian &amp; Absensi</span> Bersama Kami</h1>
                <p class="hero-section__description">Sederhanakan pekerjaan HR, pantau absensi, dan kelola penggajian tim Anda dalam satu platform yang praktis.</p>
                <a class="button button--primary" href="{{ url('login') }}">Masuk</a>
            </div>
            <div class="hero-section__visual" aria-label="Ilustrasi dashboard Gadjihan">
                <div class="illustration-placeholder illustration-placeholder--hero">ILUSTRASI</div>
            </div>
        </section>

        <section class="features-section" id="fitur">
            <div class="section-heading">
                <p class="section-kicker">Fitur aplikasi</p>
                <h2 class="section-heading__title">Semua yang Anda butuhkan</h2>
                <p class="section-heading__description">Kelola kebutuhan administrasi tim dengan lebih cepat dan terorganisir.</p>
            </div>
            <div class="feature-list">
                <article class="feature-card"><div class="illustration-placeholder illustration-placeholder--feature">ILUSTRASI</div><h3 class="feature-card__title">Penggajian mudah</h3><p class="feature-card__description">Proses penggajian yang rapi dan transparan setiap bulan.</p></article>
                <article class="feature-card"><div class="illustration-placeholder illustration-placeholder--feature">ILUSTRASI</div><h3 class="feature-card__title">Absensi akurat</h3><p class="feature-card__description">Pantau kehadiran tim secara praktis dari satu tempat.</p></article>
                <article class="feature-card"><div class="illustration-placeholder illustration-placeholder--feature">ILUSTRASI</div><h3 class="feature-card__title">Laporan terpusat</h3><p class="feature-card__description">Temukan insight penting melalui laporan yang mudah dipahami.</p></article>
            </div>
        </section>

        <section class="contact-section" id="kontak">
            <div class="contact-section__box">
                <div class="contact-section__intro">
                    <p class="section-kicker">Hubungi kami</p>
                    <h2 class="contact-section__title">Mari bicara dengan tim kami</h2>
                    <p class="contact-section__description">Punya pertanyaan atau ingin tahu lebih banyak? Kami siap membantu.</p>
                    <div class="contact-details">
                        <a class="contact-detail" href="mailto:hello@gadjihan.id"><span class="contact-detail__label">Email</span><span>hello@gadjihan.id</span></a>
                        <a class="contact-detail" href="tel:+622112345678"><span class="contact-detail__label">Call</span><span>+62 21 1234 5678</span></a>
                    </div>
                </div>
                <form class="contact-form" action="#kontak" method="post">
                    @csrf
                    <div class="contact-form__row"><label class="form-field"><span>Name</span><input type="text" name="name" placeholder="Nama Anda" required></label><label class="form-field"><span>Email</span><input type="email" name="email" placeholder="email@contoh.com" required></label></div>
                    <label class="form-field"><span>Subject</span><input type="text" name="subject" placeholder="Subjek pesan" required></label>
                    <label class="form-field"><span>Message</span><textarea name="message" rows="5" placeholder="Tulis pesan Anda" required></textarea></label>
                    <button class="button button--primary" type="submit">Send Message</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="site-footer"><div class="site-footer__inner"><img class="site-footer__logo" src="{{ asset('assets/LOGO 1.svg') }}" alt="Gadjihan"><p>© {{ date('Y') }} Gadjihan. Semua hak dilindungi.</p><div class="site-footer__links"><a href="#fitur">Fitur</a><a href="#kontak">Kontak</a></div></div></footer>
</body>
</html>

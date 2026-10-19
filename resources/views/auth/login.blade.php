<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Gadjihan Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <main class="auth-container">
        <section class="auth-card" aria-labelledby="login-title">
            <a class="auth-brand" href="{{ url('landingpage') }}"><img class="auth-brand__logo" src="{{ asset('assets/LOGO 1.svg') }}" alt="Gadjihan Admin"></a>
            <div class="auth-header"><h1 class="auth-title" id="login-title">Selamat datang kembali.</h1><p class="auth-subtitle">Masuk untuk mengelola sistem HR</p></div>
            <form class="auth-form" method="post" action="{{ url('login') }}">
                @csrf
                <div class="form-group"><label class="form-label" for="email">Email</label><input class="form-input" id="email" name="email" type="email" placeholder="admin@example.com" value="{{ old('email') }}" autocomplete="email" required></div>
                <div class="form-group"><label class="form-label" for="password">Password</label><div class="password-field"><input class="form-input" id="password" name="password" type="password" placeholder="Masukkan password" autocomplete="current-password" required><button class="password-toggle" type="button" data-password-toggle="#password" aria-label="Tampilkan password"><svg class="password-toggle__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 12s3.5-5 9.5-5 9.5 5 9.5 5-3.5 5-9.5 5-9.5-5-9.5-5Z"></path><circle cx="12" cy="12" r="2.5"></circle></svg></button></div></div>
                <label class="remember-option"><input type="checkbox" name="remember"><span>Ingat saya</span></label>
                <button class="auth-submit" type="submit">Masuk</button>
            </form>
            
        </section>
    </main>
    <footer class="auth-footer">© 2021 Copyright Gadjihan. All Rights Reserved</footer>
</body>
</html>


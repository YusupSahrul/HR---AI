<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk Gadjihan Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="auth-page">
    <div class="auth-orb auth-orb--top"></div>
    <div class="auth-orb auth-orb--right"></div>
    <div class="auth-orb auth-orb--bottom"></div>

    <main class="auth-container">
        <section class="auth-card" aria-labelledby="login-title">
            <a class="auth-brand" href="{{ url('landingpage') }}">
                <img
                    class="auth-brand__logo"
                    src="{{ asset('assets/LOGOHRIS.svg') }}"
                    alt="Gadjihan" />
            </a>
            <div class="auth-header">
                <h1 class="auth-title" id="login-title">
                    Selamat datang.
                </h1>
                <p class="auth-subtitle">
                    Masuk untuk mengelola perusahaan anda
                </p>
            </div>
            <form
                class="auth-form"
                method="post"
                action="{{ url('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input
                        class="form-input"
                        id="email"
                        name="email"
                        type="email"
                        placeholder="admin@example.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">
                        Password
                    </label>
                    <div class="password-field">
                        <input
                            class="form-input"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required />
                        <button
                            class="password-toggle"
                            type="button"
                            data-password-toggle="#password"
                            aria-label="Tampilkan password">
                            <img
                                class="password-toggle__icon"
                                src="{{ asset('assets/eye-solid-full.svg') }}"
                                alt=""
                                data-password-icon
                                aria-hidden="true" />
                        </button>
                    </div>
                </div>
                <label class="remember-option">
                    <input type="checkbox" name="remember" />
                    <span>Ingat saya</span>
                </label>
                <button class="auth-submit" type="submit">Masuk</button>
            </form>
            <p class="auth-footer">
                &copy; 2021 Gadjihan. All Rights Reserved
            </p>
        </section>
    </main>
</body>

</html>
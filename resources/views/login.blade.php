<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $usaha_nama }} | Masuk ke Sistem ERP</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/' . $usaha_logo) }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 5 Free -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE32/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap 4 / AdminLTE 3 -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE32/dist/css/adminlte.min.css') }}">

    @if (!empty($recaptcha_enabled) && !empty($recaptcha_site_key))
        <!-- Google reCAPTCHA v2 API -->
        <script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script>
    @endif

    <style>
        :root {
            --primary-color: #1e3a8a;
            --primary-hover: #172554;
            --primary-accent: #2563eb;
            --accent-gradient: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #0284c7 100%);
            --dark-surface: #0f172a;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body, html {
            height: 100%;
            margin: 0;
            background-color: #0b1120;
            color: var(--text-main);
            overflow-x: hidden;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            background: #0b1120;
        }

        /* Hero / Branding Section (Left) */
        .hero-section {
            flex: 1.15;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3.25rem 3.5rem;
            color: #ffffff;
            background-image: linear-gradient(145deg, rgba(15, 23, 42, 0.94) 0%, rgba(30, 58, 138, 0.88) 50%, rgba(15, 23, 42, 0.96) 100%), url("{{ asset('images/material-bangunan.jpg') }}");
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        /* Subtle glowing backdrop shapes */
        .hero-section::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -10%;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.22) 0%, rgba(59, 130, 246, 0) 70%);
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -15%;
            left: -10%;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.18) 0%, rgba(14, 165, 233, 0) 70%);
            pointer-events: none;
        }

        .hero-header {
            position: relative;
            z-index: 2;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.45rem 1.1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #93c5fd;
            margin-bottom: 1.25rem;
        }

        .brand-badge i {
            color: #38bdf8;
        }

        .company-branding {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .company-logo-wrap {
            width: 70px;
            height: 70px;
            background: #ffffff;
            border-radius: 16px;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
            flex-shrink: 0;
        }

        .company-logo-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .company-title {
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0;
            line-height: 1.2;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .company-subtitle {
            font-size: 0.95rem;
            color: #cbd5e1;
            margin-top: 0.35rem;
            font-weight: 400;
        }

        /* Hero Content & Feature Highlights */
        .hero-body {
            position: relative;
            z-index: 2;
            margin: 2.5rem 0;
        }

        .hero-tagline {
            font-size: 1.85rem;
            font-weight: 700;
            line-height: 1.3;
            color: #f8fafc;
            margin-bottom: 0.85rem;
            max-width: 580px;
        }

        .hero-desc {
            font-size: 0.96rem;
            line-height: 1.6;
            color: #94a3b8;
            max-width: 530px;
            margin-bottom: 2rem;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            max-width: 600px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 14px;
            padding: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.9rem;
            transition: all 0.25s ease;
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.09);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .feature-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.25) 0%, rgba(37, 99, 235, 0.4) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #60a5fa;
            font-size: 1.05rem;
            flex-shrink: 0;
            border: 1px solid rgba(96, 165, 250, 0.3);
        }

        .feature-card-content h6 {
            font-size: 0.92rem;
            font-weight: 600;
            margin: 0 0 0.2rem 0;
            color: #f1f5f9;
        }

        .feature-card-content p {
            font-size: 0.78rem;
            color: #94a3b8;
            margin: 0;
            line-height: 1.35;
        }

        /* Hero Footer / Live Server Clock & Contact */
        .hero-footer {
            position: relative;
            z-index: 2;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .live-clock-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            color: #cbd5e1;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .company-contact-mini {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            font-size: 0.82rem;
            color: #94a3b8;
        }

        .company-contact-mini span {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .company-contact-mini i {
            color: #38bdf8;
        }

        /* Login Form Section (Right) */
        .form-section {
            flex: 0.85;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2.5rem;
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 440px;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .mobile-logo-wrap {
            display: none;
            margin-bottom: 1.25rem;
            align-items: center;
            gap: 0.75rem;
        }

        .mobile-logo-wrap img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: #ffffff;
            border-radius: 10px;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .mobile-logo-wrap h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            color: var(--dark-surface);
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--dark-surface);
            letter-spacing: -0.5px;
            margin-bottom: 0.4rem;
        }

        .form-subtitle {
            font-size: 0.92rem;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.5;
        }

        /* Modern Form Inputs */
        .form-group-custom {
            margin-bottom: 1.35rem;
            position: relative;
        }

        .form-label-custom {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .input-group-modern {
            position: relative;
            display: flex;
            align-items: center;
            background: #f8fafc;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            transition: all 0.2s ease-in-out;
        }

        .input-group-modern:focus-within {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .input-icon-lead {
            width: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        .input-group-modern:focus-within .input-icon-lead {
            color: #2563eb;
        }

        .form-control-modern {
            width: 100%;
            height: 48px;
            border: none;
            background: transparent;
            font-size: 0.95rem;
            color: var(--dark-surface);
            padding: 0 0.75rem 0 0;
            outline: none;
            font-weight: 500;
        }

        .form-control-modern::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .btn-toggle-password {
            background: transparent;
            border: none;
            color: #94a3b8;
            padding: 0 1rem;
            cursor: pointer;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        .btn-toggle-password:hover,
        .btn-toggle-password:focus {
            color: #334155;
            outline: none;
        }

        /* Caps Lock Alert */
        .caps-warning {
            display: none;
            margin-top: 0.4rem;
            font-size: 0.78rem;
            color: #d97706;
            font-weight: 600;
            align-items: center;
            gap: 0.35rem;
        }

        /* Checkbox & Forgot link row */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1.25rem 0 1.75rem 0;
            font-size: 0.85rem;
        }

        .custom-checkbox-wrap {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            user-select: none;
            color: #475569;
            font-weight: 500;
            gap: 0.5rem;
            margin: 0;
        }

        .custom-checkbox-wrap input {
            cursor: pointer;
            width: 16px;
            height: 16px;
            accent-color: #2563eb;
            border-radius: 4px;
        }

        .help-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .help-link:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        /* Google reCAPTCHA v2 Checkbox */
        .recaptcha-wrapper {
            margin: 0.25rem 0 1.25rem 0;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        @media (max-width: 480px) {
            .recaptcha-wrapper {
                overflow-x: auto;
            }
        }

        /* Login Button */
        .btn-submit-modern {
            width: 100%;
            height: 50px;
            background: var(--accent-gradient);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
            transition: all 0.25s ease;
        }

        .btn-submit-modern:hover {
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.45);
            transform: translateY(-1.5px);
            filter: brightness(1.05);
        }

        .btn-submit-modern:active {
            transform: translateY(0);
        }

        .btn-submit-modern:disabled {
            opacity: 0.75;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Security Notice Box */
        .security-badge-box {
            margin-top: 2rem;
            padding: 0.85rem 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .security-badge-icon {
            color: #10b981;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .security-badge-text {
            font-size: 0.78rem;
            color: #64748b;
            line-height: 1.4;
            margin: 0;
        }

        /* Footer in form */
        .form-footer {
            margin-top: 1.75rem;
            text-align: center;
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Alert Box */
        .alert-custom-login {
            border-radius: 10px;
            font-size: 0.86rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            display: none;
            border-left: 4px solid #ef4444;
        }

        /* Shake animation on failure */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }

        .shake {
            animation: shake 0.4s ease-in-out;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .hero-section {
                display: none;
            }

            .form-section {
                flex: 1;
                padding: 2.5rem 1.5rem;
                background: #f8fafc;
            }

            .form-container {
                background: #ffffff;
                padding: 2.25rem 1.75rem;
                border-radius: 18px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
                border: 1px solid #e2e8f0;
            }

            .mobile-logo-wrap {
                display: flex;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 1.5rem 1.25rem;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .options-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <!-- ========================================== -->
        <!-- HERO / BRANDING SECTION (LEFT)             -->
        <!-- ========================================== -->
        <section class="hero-section">
            <div class="hero-header">
                <div class="brand-badge">
                    <i class="fas fa-cubes"></i> SISTEM ERP DISTRIBUSI &amp; LOGISTIK
                </div>
                <div class="company-branding">
                    <div class="company-logo-wrap">
                        <img src="{{ asset('images/' . $usaha_logo) }}" alt="Logo {{ $usaha_nama }}">
                    </div>
                    <div>
                        <h1 class="company-title">{{ $usaha_nama }}</h1>
                        <div class="company-subtitle">
                            {{ $usaha_nama_singkat ? $usaha_nama_singkat . ' • ' : '' }}Integrated Business &amp; Distribution ERP
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-body">
                <div class="hero-tagline">
                    Kelola Operasional Distribusi, Persediaan &amp; Keuangan Lebih Presisi
                </div>
                <p class="hero-desc">
                    Platform terpadu untuk pencatatan transaksi pembelian, penjualan barang, surat jalan, penagihan piutang konsumen, hingga pembukuan akuntansi otomatis.
                </p>

                <!-- 4 Key Feature Cards -->
                <div class="feature-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="feature-card-content">
                            <h6>Manajemen Stok FIFO</h6>
                            <p>Pelacakan persediaan real-time dengan kalkulasi HPP FIFO akurat.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="feature-card-content">
                            <h6>Distribusi &amp; Pengiriman</h6>
                            <p>Surat jalan, ekspedisi dan kontrol logistik terintegrasi cepat.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="feature-card-content">
                            <h6>Hutang &amp; Piutang Usaha</h6>
                            <p>Monitoring jatuh tempo pembayaran &amp; performa bonus sales.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="feature-card-content">
                            <h6>Laporan Finansial Otomatis</h6>
                            <p>Jurnal umum, neraca saldo, arus kas, dan laba rugi instan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Footer: Live Clock & Contacts -->
            <div class="hero-footer">
                <div class="live-clock-card">
                    <div class="status-dot"></div>
                    <div>
                        <span id="liveClockText">Memuat waktu sistem...</span>
                        <span class="badge badge-primary ml-1" style="font-size: 0.7rem; background-color: rgba(59, 130, 246, 0.35);">Online</span>
                    </div>
                </div>

                <div class="company-contact-mini">
                    @if (!empty($usaha_alamat))
                        <span title="{{ $usaha_alamat }}">
                            <i class="fas fa-map-marker-alt"></i> {{ \Illuminate\Support\Str::limit($usaha_alamat, 32) }}
                        </span>
                    @endif
                    @if (!empty($usaha_telepon))
                        <span>
                            <i class="fas fa-phone-alt"></i> {{ $usaha_telepon }}
                        </span>
                    @endif
                </div>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- FORM LOGIN SECTION (RIGHT)                -->
        <!-- ========================================== -->
        <section class="form-section">
            <div class="form-container" id="loginCard">

                <!-- Header for mobile / tablet -->
                <div class="mobile-logo-wrap">
                    <img src="{{ asset('images/' . $usaha_logo) }}" alt="Logo {{ $usaha_nama }}">
                    <div>
                        <h5>{{ $usaha_nama }}</h5>
                        <small class="text-muted">ERP Sistem Distribusi</small>
                    </div>
                </div>

                <div class="form-header">
                    <h2 class="form-title">Selamat Datang Lae</h2>
                    <p class="form-subtitle">Masukkan username dan password Anda untuk masuk ke sistem.</p>
                </div>

                <!-- Alert Message Container -->
                <div class="alert alert-danger alert-custom-login" id="alertBox" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span id="alertMessage">Username atau password salah.</span>
                </div>

                <!-- Login Form -->
                <form id="form" method="POST" autocomplete="off">
                    @csrf

                    <!-- Input Username -->
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="username">
                            <i class="fas fa-user mr-1 text-primary"></i> Username
                        </label>
                        <div class="input-group-modern">
                            <div class="input-icon-lead">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <input type="text"
                                   class="form-control-modern"
                                   name="username"
                                   id="username"
                                   placeholder="Masukkan username Anda"
                                   required
                                   autofocus>
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="password">
                            <i class="fas fa-lock mr-1 text-primary"></i> Password
                        </label>
                        <div class="input-group-modern">
                            <div class="input-icon-lead">
                                <i class="fas fa-key"></i>
                            </div>
                            <input type="password"
                                   class="form-control-modern"
                                   name="password"
                                   id="password"
                                   placeholder="Masukkan password Anda"
                                   required>
                            <button type="button" class="btn-toggle-password" id="btnTogglePassword" title="Tampilkan / Sembunyikan Password" tabindex="-1">
                                <i class="fas fa-eye" id="iconEye"></i>
                            </button>
                        </div>
                        <div class="caps-warning" id="capsWarning">
                            <i class="fas fa-exclamation-triangle"></i> Peringatan: Caps Lock sedang aktif!
                        </div>
                    </div>

                    <!-- Options: Remember Me & Help Modal -->
                    <div class="options-row">
                        <label class="custom-checkbox-wrap" for="rememberMe">
                            <input type="checkbox" name="remember-me" id="rememberMe">
                            <span>Ingat saya untuk 7 hari</span>
                        </label>
                        <a href="javascript:void(0)" class="help-link" data-toggle="modal" data-target="#modalBantuan">
                            <i class="far fa-question-circle"></i> Butuh bantuan?
                        </a>
                    </div>

                    @if (!empty($recaptcha_enabled) && !empty($recaptcha_site_key))
                        <!-- Google reCAPTCHA v2 Checkbox -->
                        <div class="recaptcha-wrapper">
                            <div class="g-recaptcha" data-sitekey="{{ $recaptcha_site_key }}"></div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit-modern" id="btnSubmit">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Masuk ke Akun</span>
                    </button>
                </form>

                <!-- Security Trust Badge -->
                <div class="security-badge-box">
                    <div class="security-badge-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <p class="security-badge-text">
                        Akses sistem terproteksi dan diaudit. Setiap aktivitas transaksi dicatat dalam riwayat audit trail perusahaan.
                    </p>
                </div>

                <!-- Footer Copyright -->
                <div class="form-footer">
                    &copy; {{ date('Y') }} <strong>{{ $usaha_nama }}</strong>.<br>
                    Hak Cipta Dilindungi Undang-Undang.
                </div>

            </div>
        </section>

    </div>

    <!-- ========================================== -->
    <!-- MODAL BANTUAN & KONTAK IT                  -->
    <!-- ========================================== -->
    <div class="modal fade" id="modalBantuan" tabindex="-1" role="dialog" aria-labelledby="modalBantuanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e3a8a, #2563eb); color: #fff; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h5 class="modal-title font-weight-bold" id="modalBantuanLabel">
                        <i class="fas fa-headset mr-2"></i> Bantuan &amp; Dukungan Akun
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #eff6ff; display: inline-flex; align-items: center; justify-content: center; color: #2563eb; font-size: 1.5rem; margin-bottom: 0.75rem;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h6 class="font-weight-bold mb-1">Lupa Password atau Terkendala Akses?</h6>
                        <p class="text-muted small">Untuk menjaga integritas dan keamanan data perusahaan, perubahan kredensial hanya dapat diproses oleh Administrator Sistem.</p>
                    </div>

                    <div class="card bg-light border-0 p-3 mb-3" style="border-radius: 12px;">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-building text-primary mr-2" style="width: 20px;"></i>
                            <span class="small font-weight-bold text-dark">{{ $usaha_nama }}</span>
                        </div>
                        @if (!empty($usaha_alamat))
                            <div class="d-flex align-items-start mb-2">
                                <i class="fas fa-map-marker-alt text-danger mr-2 mt-1" style="width: 20px;"></i>
                                <span class="small text-muted">{{ $usaha_alamat }}</span>
                            </div>
                        @endif
                        @if (!empty($usaha_telepon))
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone-alt text-success mr-2" style="width: 20px;"></i>
                                <span class="small text-muted">{{ $usaha_telepon }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="alert alert-info py-2 px-3 small mb-0" style="border-radius: 8px;">
                        <i class="fas fa-info-circle mr-1"></i>
                        Silakan hubungi bagian IT/Administrator kantor dengan membawa identitas pegawai yang terdaftar.
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary btn-block font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- SCRIPTS                                    -->
    <!-- ========================================== -->
    <script src="{{ asset('assets/AdminLTE32/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE32/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Focus on username immediately
            $('#username').focus();

            // Toggle Password Visibility
            $('#btnTogglePassword').on('click', function () {
                const passInput = $('#password');
                const iconEye = $('#iconEye');
                const isPassword = passInput.attr('type') === 'password';

                if (isPassword) {
                    passInput.attr('type', 'text');
                    iconEye.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passInput.attr('type', 'password');
                    iconEye.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Detect Caps Lock on Password Input
            $('#password').on('keyup keydown', function (e) {
                if (e.originalEvent && typeof e.originalEvent.getModifierState === 'function') {
                    if (e.originalEvent.getModifierState('CapsLock')) {
                        $('#capsWarning').css('display', 'inline-flex');
                    } else {
                        $('#capsWarning').hide();
                    }
                }
            });

            // Live Real-Time Clock (Indonesian format)
            function updateClock() {
                const now = new Date();
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];

                const dayName = days[now.getDay()];
                const date = now.getDate();
                const monthName = months[now.getMonth()];
                const year = now.getFullYear();

                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');

                const clockString = `${dayName}, ${date} ${monthName} ${year} • ${hours}:${minutes}:${seconds} WIB`;
                $('#liveClockText').text(clockString);
            }

            updateClock();
            setInterval(updateClock, 1000);

            // Hide inline alert when typing
            $('#username, #password').on('input', function () {
                $('#alertBox').slideUp(200);
            });

            // AJAX Form Submit
            $('#form').on('submit', function (e) {
                e.preventDefault();

                const submitBtn = $('#btnSubmit');
                const originalHtml = submitBtn.html();
                const loginCard = $('#loginCard');

                @if (!empty($recaptcha_enabled) && !empty($recaptcha_site_key))
                    if (typeof grecaptcha !== 'undefined') {
                        const recaptchaResponse = grecaptcha.getResponse();
                        if (!recaptchaResponse) {
                            const errMsg = "Silakan centang verifikasi 'Saya bukan robot' (reCAPTCHA) terlebih dahulu.";
                            $('#alertMessage').text(errMsg);
                            $('#alertBox').slideDown(200);

                            loginCard.addClass('shake');
                            setTimeout(() => {
                                loginCard.removeClass('shake');
                            }, 500);

                            swal("Verifikasi Diperlukan", errMsg, "warning");
                            return;
                        }
                    }
                @endif

                // Set loading state
                submitBtn.html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Memverifikasi...').prop('disabled', true);
                $('#alertBox').slideUp(150);

                $.ajax({
                    url: "{{ url('login') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Memuat sesi & menu pengguna...');

                            $.ajax({
                                url: "{{ url('login/loadMenus') }}",
                                type: 'GET',
                                dataType: 'json'
                            })
                            .done(function () {
                                submitBtn.html('<i class="fas fa-check mr-2"></i> Berhasil! Mengalihkan...');
                                window.location.href = "{{ url('/') }}";
                            })
                            .fail(function () {
                                // Tetap redirect ke home meskipun loadMenus async gagal
                                window.location.href = "{{ url('/') }}";
                            });

                        } else {
                            if (typeof grecaptcha !== 'undefined') {
                                grecaptcha.reset();
                            }

                            submitBtn.html(originalHtml).prop('disabled', false);

                            const errMsg = response.message || "Username atau password salah.";
                            $('#alertMessage').text(errMsg);
                            $('#alertBox').slideDown(200);

                            // Trigger shake animation
                            loginCard.addClass('shake');
                            setTimeout(() => {
                                loginCard.removeClass('shake');
                            }, 500);

                            swal("Gagal Masuk", errMsg, "error")
                                .then(() => {
                                    $('#username').focus();
                                });
                        }
                    },
                    error: function (xhr) {
                        if (typeof grecaptcha !== 'undefined') {
                            grecaptcha.reset();
                        }

                        submitBtn.html(originalHtml).prop('disabled', false);
                        let errMsg = "Terjadi kesalahan pada server.";

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            errMsg = Object.values(errors).flat().join("\n");
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }

                        $('#alertMessage').text(errMsg);
                        $('#alertBox').slideDown(200);

                        loginCard.addClass('shake');
                        setTimeout(() => {
                            loginCard.removeClass('shake');
                        }, 500);

                        swal("Kesalahan!", errMsg, "error")
                            .then(() => {
                                $('#username').focus();
                            });
                    }
                });
            });
        });
    </script>

    @if (session('message'))
        <script>
            swal("Informasi", "{{ session('message') }}", "info")
                .then(() => {
                    $('#username').focus();
                });
        </script>
    @endif

</body>

</html>
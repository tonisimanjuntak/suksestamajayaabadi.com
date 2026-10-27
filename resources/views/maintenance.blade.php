<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemeliharaan Sistem | {{ $usaha_nama ?? 'Sistem ERP' }}</title>

    @if (!empty($usaha_logo))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/' . $usaha_logo) }}">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 5 Free -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE32/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE32/dist/css/adminlte.min.css') }}">

    <style>
        :root {
            --primary-color: #2563eb;
            --accent-glow: #38bdf8;
            --dark-bg: #0b1120;
            --card-bg: rgba(15, 23, 42, 0.85);
            --card-border: rgba(148, 163, 184, 0.15);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body, html {
            height: 100%;
            margin: 0;
            background-color: var(--dark-bg);
            color: var(--text-main);
            overflow-x: hidden;
        }

        .maintenance-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            background: radial-gradient(circle at 50% 20%, rgba(37, 99, 235, 0.18) 0%, transparent 60%),
                        radial-gradient(circle at 80% 80%, rgba(56, 189, 248, 0.12) 0%, transparent 50%),
                        radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.10) 0%, transparent 50%),
                        #0b1120;
        }

        .maintenance-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            max-width: 680px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 40px rgba(37, 99, 235, 0.15);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            position: relative;
            z-index: 2;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-container {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.75rem;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2), rgba(56, 189, 248, 0.2));
            border: 1px solid rgba(56, 189, 248, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 0 25px rgba(56, 189, 248, 0.3);
        }

        .icon-container i.fa-tools {
            font-size: 2.5rem;
            color: #38bdf8;
            animation: rotateTools 6s ease-in-out infinite alternate;
        }

        @keyframes rotateTools {
            0% { transform: rotate(-10deg); }
            100% { transform: rotate(10deg); }
        }

        .company-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 9999px;
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #e2e8f0;
            letter-spacing: 0.5px;
        }

        .company-badge img {
            width: 20px;
            height: 20px;
            object-fit: contain;
            border-radius: 4px;
        }

        .title {
            font-size: 1.95rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.75rem;
            line-height: 1.25;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 2.25rem;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Countdown Section */
        .countdown-wrapper {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.12);
            border-radius: 18px;
            padding: 1.5rem 1.25rem;
            margin-bottom: 2rem;
        }

        .countdown-title {
            font-size: 0.825rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #38bdf8;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .timer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            max-width: 480px;
            margin: 0 auto;
        }

        .timer-box {
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 14px;
            padding: 0.85rem 0.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        .timer-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #2563eb, #38bdf8);
        }

        .timer-val {
            font-size: 2rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
            margin-bottom: 0.35rem;
            font-variant-numeric: tabular-nums;
        }

        .timer-lbl {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            font-weight: 600;
        }

        .target-time-note {
            font-size: 0.85rem;
            color: #94a3b8;
            margin-top: 1rem;
        }

        .target-time-note strong {
            color: #e2e8f0;
        }

        /* Status Finished Banner */
        .countdown-finished {
            display: none;
            padding: 1rem;
            border-radius: 12px;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Buttons */
        .btn-action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-refresh {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.75rem 1.75rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .btn-refresh:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
            color: #ffffff;
        }

        .btn-logout {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.25);
            color: #e2e8f0;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: rgba(51, 65, 85, 0.9);
            color: #ffffff;
            text-decoration: none;
            border-color: rgba(148, 163, 184, 0.4);
        }

        .footer-note {
            margin-top: 2rem;
            font-size: 0.8rem;
            color: #64748b;
        }

        @media (max-width: 576px) {
            .maintenance-card {
                padding: 2rem 1.5rem;
            }

            .title {
                font-size: 1.5rem;
            }

            .timer-val {
                font-size: 1.5rem;
            }

            .timer-grid {
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="maintenance-wrapper">
        <div class="maintenance-card">
            <!-- Company / App Badge -->
            <div class="company-badge">
                @if (!empty($usaha_logo))
                    <img src="{{ asset('images/' . $usaha_logo) }}" alt="{{ $usaha_nama_singkat ?? 'Logo' }}">
                @else
                    <i class="fas fa-building text-primary"></i>
                @endif
                <span>{{ $usaha_nama ?? 'Sistem ERP Distribusi' }}</span>
            </div>

            <!-- Icon -->
            <div class="icon-container">
                <i class="fas fa-tools"></i>
            </div>

            <!-- Title & Subtitle -->
            <h1 class="title">Sistem Sedang Dalam Pemeliharaan</h1>
            <p class="subtitle">
                Kami sedang melakukan pemeliharaan dan peningkatan performa sistem demi kenyamanan transaksi Anda. 
                Aplikasi akan segera dapat diakses kembali setelah proses selesai.
            </p>

            <!-- Countdown Timer Block -->
            <div class="countdown-wrapper">
                <div class="countdown-title">
                    <i class="far fa-clock"></i> Estimasi Waktu Sisa
                </div>

                <div class="timer-grid" id="timerGrid">
                    <div class="timer-box">
                        <div class="timer-val" id="daysVal">00</div>
                        <div class="timer-lbl">Hari</div>
                    </div>
                    <div class="timer-box">
                        <div class="timer-val" id="hoursVal">00</div>
                        <div class="timer-lbl">Jam</div>
                    </div>
                    <div class="timer-box">
                        <div class="timer-val" id="minutesVal">00</div>
                        <div class="timer-lbl">Menit</div>
                    </div>
                    <div class="timer-box">
                        <div class="timer-val" id="secondsVal">00</div>
                        <div class="timer-lbl">Detik</div>
                    </div>
                </div>

                <div class="countdown-finished" id="timerFinished">
                    <i class="fas fa-check-circle mr-1"></i> Waktu estimasi pemeliharaan telah berakhir. Developer sedang berusaha mengaktifkan kembali sistem, harap tunggu, atau hubungi pihak Pengembang.
                </div>

                @if (!empty($estimated_finished))
                    <div class="target-time-note" id="targetTimeNote">
                        Perkiraan selesai: <strong>{{ $estimated_finished }}</strong>
                    </div>
                @else
                    <div class="target-time-note">
                        Estimasi selesai: <strong>Segera kembali</strong>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="btn-action-group">
                <button type="button" class="btn-refresh" onclick="window.location.reload();">
                    <i class="fas fa-sync-alt"></i> Muat Ulang Halaman
                </button>
                <a href="{{ route('logout') }}" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Keluar Sistem
                </a>
            </div>

            <!-- Footer -->
            <div class="footer-note">
                &copy; {{ date('Y') }} {{ $usaha_nama ?? 'Sistem ERP' }}. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </div>

    <script>
        (function() {
            const rawTarget = "{{ $estimated_finished ?? '' }}";
            const timerGrid = document.getElementById('timerGrid');
            const timerFinished = document.getElementById('timerFinished');
            const daysEl = document.getElementById('daysVal');
            const hoursEl = document.getElementById('hoursVal');
            const minutesEl = document.getElementById('minutesVal');
            const secondsEl = document.getElementById('secondsVal');

            if (!rawTarget) {
                // Jika tidak ada target estimasi yang diset
                daysEl.textContent = "--";
                hoursEl.textContent = "--";
                minutesEl.textContent = "--";
                secondsEl.textContent = "--";
                return;
            }

            // Normalisasi tanggal target (ganti spasi menjadi T jika format 'YYYY-MM-DD HH:MM:SS')
            const normalizedTarget = rawTarget.replace(' ', 'T');
            const targetDate = new Date(normalizedTarget);

            if (isNaN(targetDate.getTime())) {
                daysEl.textContent = "--";
                hoursEl.textContent = "--";
                minutesEl.textContent = "--";
                secondsEl.textContent = "--";
                return;
            }

            function updateTimer() {
                const now = new Date().getTime();
                const diff = targetDate.getTime() - now;

                if (diff <= 0) {
                    timerGrid.style.display = 'none';
                    timerFinished.style.display = 'block';
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                daysEl.textContent = String(days).padStart(2, '0');
                hoursEl.textContent = String(hours).padStart(2, '0');
                minutesEl.textContent = String(minutes).padStart(2, '0');
                secondsEl.textContent = String(seconds).padStart(2, '0');
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        })();
    </script>
</body>

</html>

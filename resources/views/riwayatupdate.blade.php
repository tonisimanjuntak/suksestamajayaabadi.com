@extends('template/layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Riwayat Update</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="">
                                <h3 class="card-title font-weight-bold"><i class="far fa-list-alt mr-1"></i>Riwayat
                                    Update Aplikasi</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php
                                $filePath = public_path('logupdate.txt');
                                $stringUpdate = '';

                                if (file_exists($filePath)) {
                                $stringUpdate = file_get_contents($filePath);
                                } else {
                                $stringUpdate = "Belum ada riwayat update.\nSilakan buat file storage/app/logupdate.txt
                                dengan format:\n[tgl] [jenis] deskripsi\nContoh: [2026-04-28] [customize] kartu stok";
                                }

                                $lines = array_filter(explode("\n", $stringUpdate), function($line) {
                                return trim($line) !== '';
                                });

                                // Kelompokkan berdasarkan tanggal
                                $grouped = [];
                                foreach ($lines as $line) {
                                $date = null;
                                $type = 'update';
                                $description = $line;

                                if (preg_match('/^\[(\d{4}-\d{2}-\d{2})\]\s*\[(\w+)\]\s*(.*)$/', $line, $matches)) {
                                $date = $matches[1];
                                $type = strtolower($matches[2]);
                                $description = $matches[3];
                                } elseif (preg_match('/^\[(\d{4}-\d{2}-\d{2})\]\s*(.*)$/', $line, $matches)) {
                                $date = $matches[1];
                                $description = $matches[2];
                                $type = 'update';
                                }

                                if ($date) {
                                $grouped[$date][] = [
                                'type' => $type,
                                'description' => $description,
                                'raw' => $line
                                ];
                                } else {
                                // Jika tidak ada format tanggal, masukkan ke grup 'Lainnya'
                                $grouped['Lainnya'][] = [
                                'type' => $type,
                                'description' => $line,
                                'raw' => $line
                                ];
                                }
                                }

                                // Urutkan tanggal descending (terbaru di atas)
                                uksort($grouped, function($a, $b) {
                                if ($a === 'Lainnya') return 1;
                                if ($b === 'Lainnya') return -1;
                                return strtotime($b) - strtotime($a);
                                });
                                @endphp

                                @if(!empty($grouped))
                                <div class="col-12">
                                    <div class="timeline">
                                        @foreach($grouped as $tanggal => $items)
                                        <!-- Badge tanggal -->
                                        <div class="time-label">
                                            <span class="bg-{{ $tanggal === 'Lainnya' ? 'secondary' : 'primary' }}">
                                                {{ $tanggal === 'Lainnya' ? 'Riwayat Lain' :
                                                \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                            </span>
                                        </div>

                                        <!-- Daftar update untuk tanggal tersebut -->
                                        @foreach($items as $item)
                                        @php
                                        $type = $item['type'];
                                        $description = $item['description'];

                                        // Tentukan ikon dan warna berdasarkan jenis
                                        $iconClass = 'fa-code-branch';
                                        $badgeColor = 'primary';
                                        if ($type == 'customize') {
                                        $iconClass = 'fa-paint-brush';
                                        $badgeColor = 'info';
                                        } elseif ($type == 'bugfix') {
                                        $iconClass = 'fa-bug';
                                        $badgeColor = 'danger';
                                        } elseif ($type == 'feature' || $type == 'new form') {
                                        $iconClass = 'fa-star';
                                        $badgeColor = 'success';
                                        } elseif ($type == 'improvement') {
                                        $iconClass = 'fa-arrow-up';
                                        $badgeColor = 'warning';
                                        }
                                        @endphp
                                        <div>
                                            <i class="fas {{ $iconClass }} bg-{{ $badgeColor }}"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header p-0">
                                                    <span class="badge badge-{{ $badgeColor }}">{{ ucfirst($type)
                                                        }}</span>
                                                </h3>
                                                <div class="timeline-body p-0">
                                                    {{ $description }}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endforeach
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-12">
                                    <div class="alert alert-info">Tidak ada riwayat update tersedia.</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Jika diperlukan script tambahan
</script>
@endsection
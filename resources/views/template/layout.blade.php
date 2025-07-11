<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ session()->get('usaha_nama') }} </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/'.session()->get('usaha_logo')) }}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('') }}assets/AdminLTE32/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('') }}assets/AdminLTE32/dist/css/adminlte.min.css">

    <!-- datatables -->
    <link href="{{ asset('') }}assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- jquery-ui -->
    <link rel="stylesheet" href="{{ asset('') }}assets/jquery-ui/themes/base/jquery-ui.css">
    <!-- select2 -->
    <link href="{{ asset('') }}assets/select2/css/select2.min.css" rel="stylesheet" />
    <!-- NotifIT -->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/notifit/css/notifIt.css">
    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/custom/custom.css">


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('template/topnavbar')

        @include('template/sidenavbar')

        @yield('content')

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <footer class="main-footer">
            <strong>Copyright {{ date('Y')}} &copy;.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>{{ session('usaha_nama') }}</b>
            </div>
        </footer>

    </div>



    <!-- jQuery -->
    <script src="{{ asset('') }}assets/AdminLTE32/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('') }}assets/AdminLTE32/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('') }}assets/AdminLTE32/dist/js/adminlte.js"></script>


    <!-- datatables -->
    <script src="{{ asset('') }}assets/datatables/js/jquery.dataTables.min.js"></script>
    <!-- jquery-mask -->
    <script type="text/javascript" src="{{ asset('') }}assets/jquery_mask/jquery.mask.js"></script>
    <!-- Bootstrap validator -->
    <script src="{{ asset('') }}assets/bootstrap-validator/js/bootstrapValidator.js"></script>
    <!-- jquery-ui -->
    <script src="{{ asset('') }}assets/jquery-ui/jquery-ui-2.js"></script>
    <!-- NotifIT -->
    <script type="text/javascript" src="{{ asset('') }}assets/notifit/js/notifIt.js"></script>
    <!-- select2 -->
    <script src="{{ asset('') }}assets/select2/js/select2.min.js"></script>
    <!-- sweet Alert -->
    <script src="{{ asset('') }}assets/sweetalert/sweetalert.min.js"></script>
    <!-- CK Editor -->
    <script type="text/javascript" src="{{ asset('') }}assets/ckeditor/ckeditor.js"></script>
    <!-- Custom -->
    <script type="text/javascript" src="{{ asset('') }}assets/custom/custom.js"></script>


    @if (session('success'))
    <script>
        swal("Berhasil", "{{ session('success') }}", "success");
    </script>
    @endif

    @if (session('fail'))
    <script>
        swal("Gagal", "{{ session('fail') }}", "warning");
    </script>
    @endif

    @if (session('other'))
    <script>
        swal("Upps!", "{{ session('other') }}", "info");
    </script>
    @endif







    @yield('scripts')


    <script>
        $(".rupiah").mask("000,000,000,000", {
            reverse: true,
            placeholder: "000,000,000,000"
        });
        $(".rupiah").css("text-align", "right");

        $(".persen").mask("000.00", {
            reverse: true,
            placeholder: "000.00"
        });

        $(".persen").css("text-align", "right");

        $(".nik").mask("0000000000000000", {
            reverse: true,
            placeholder: "Nomor induk kependudukan"
        });
        $(".notelp").mask("00000000000000000000", {
            reverse: true,
            placeholder: "Nomor telepon"
        });
        $(".nowa").mask("00000000000000000000", {
            reverse: true,
            placeholder: "Nomor whatsapp"
        });
        $(".npwp").mask("000000000000000", {
            reverse: true,
            placeholder: "Nomor pokok wajib pajak"
        });
        $(".kdakun1").mask("0", {
            reverse: true,
            placeholder: "X"
        });
        $(".kdakun2").mask("0.0", {
            reverse: true,
            placeholder: "X.X"
        });
        $(".kdakun3").mask("0.0.00", {
            reverse: true,
            placeholder: "X.X.XX"
        });
        $(".kdakun4").mask("0.0.00.00", {
            reverse: true,
            placeholder: "X.X.XX.XX"
        });

        $("#nobilyetgiro").mask("S", {
            translation: {
                "S": {
                    pattern: /[^ ]/, // Hanya karakter selain spasi
                    recursive: true
                }
            },
            placeholder: "Nomor bilyet giro"
        }).on('input', function () {
            // Konversi otomatis ke huruf besar
            $(this).val(function (_, val) {
                return val.toUpperCase();
            });
        });

        $("input#nofaktur").mask("S", {
            translation: {
                "S": {
                    pattern: /[^ ]/, // Hanya karakter selain spasi
                    recursive: true
                }
            },
            placeholder: "Nomor Faktur"
        }).on('input', function () {
            // Konversi otomatis ke huruf besar
            $(this).val(function (_, val) {
                return val.toUpperCase();
            });
        });

        $("input#noinvoice").mask("S", {
            translation: {
                "S": {
                    pattern: /[^ ]/, // Hanya karakter selain spasi
                    recursive: true
                }
            },
            placeholder: "Nomor Invoice"
        }).on('input', function () {
            // Konversi otomatis ke huruf besar
            $(this).val(function (_, val) {
                return val.toUpperCase();
            });
        });

        $("input#kdbarang").mask("S", {
            translation: {
                "S": {
                    pattern: /[^ ]/, // Hanya karakter selain spasi
                    recursive: true
                }
            },
            placeholder: "Kode Barang"
        }).on('input', function () {
            // Konversi otomatis ke huruf besar
            $(this).val(function (_, val) {
                return val.toUpperCase();
            });
        });

        


        function format_decimal(number, decPlaces, decSep, thouSep) {
            decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSep = typeof decSep === "undefined" ? "." : decSep;
            thouSep = typeof thouSep === "undefined" ? "," : thouSep;
            var sign = number < 0 ? "-" : "";
            var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
            var j = (j = i.length) > 3 ? j % 3 : 0;

            return sign +
                (j ? i.substr(0, j) + thouSep : "") +
                i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
                (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
        }

        function format_rupiah(number, decPlaces = 0, decSep = ".", thouSep = ",") {
            // Pastikan number adalah angka
            number = parseFloat(number);
            if (isNaN(number)) {
                return "0";
            }

            // Tentukan tanda (negatif atau positif)
            var sign = number < 0 ? "-" : "";

            // Ambil bagian integer
            var i = String(Math.floor(Math.abs(number)));

            // Tambahkan separator ribuan
            var j = i.length > 3 ? i.length % 3 : 0;
            var thousands = (j ? i.substr(0, j) + thouSep : "") +
                i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSep);

            // Ambil bagian desimal
            var decimals = decPlaces ? decSep + Math.abs(number - Math.floor(number)).toFixed(decPlaces).slice(2) : "";

            // Gabungkan semua bagian
            return sign + thousands + decimals;
        }

        function addSelectOption(selectId, optValue, optText) {
            var select = document.getElementById(selectId);
            var option = document.createElement("option");
            option.value = optValue;
            option.innerHTML = optText;
            select.appendChild(option);
        }

        function hilangkanTitik(input) {
            // Menggunakan metode replace dengan regular expression untuk menghapus semua tanda titik
            return input.replace(/\./g, '');
        }


        
    </script>


    <script>
        $(document).ready(function() {

            $('.searchBarang').select2({
                placeholder: 'Cari nama barang...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('barang.searchBarang') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
                templateResult: formatBarang, // Fungsi untuk menampilkan hasil di dropdown
                templateSelection: formatBarangSelection // Fungsi untuk menampilkan hasil yang dipilih
            });

            $('.searchJenisBarang').select2({
                placeholder: 'Cari jenis barang...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('jenisbarang.searchJenisBarang') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchKategori').select2({
                placeholder: 'Cari nama kategori...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('kategoribarang.searchKategori') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });


            $('.searchKasir').select2({
                placeholder: 'Cari nama kasir...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('pengguna.searchKasir') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchSupplier').select2({
                placeholder: 'Cari nama supplier...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('supplier.searchSupplier') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchSales').select2({
                placeholder: 'Cari nama sales...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('sales.searchSales') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchEkspedisi').select2({
                placeholder: 'Cari nama ekspedisi...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('ekspedisi.searchEkspedisi') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchJenisEkspedisi').select2({
                placeholder: 'Cari jenis ekspedisi...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('jenisekspedisi.searchJenisEkspedisi') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });


            $('.searchWilayah').select2({
                placeholder: 'Cari wilayah...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('wilayah.searchWilayah') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });


            

            $('.searchKonsumen').select2({
                placeholder: 'Cari nama konsumen...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('konsumen.searchKonsumen') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchBank').select2({
                placeholder: 'Cari nama bank...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('bank.searchBank') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchJenisPiutang').select2({
                placeholder: 'Cari jenis piutang...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('jenispiutang.searchJenisPiutang') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            // $('.searchAkunAll').select2({
            //     placeholder: 'Cari akun...',
            //     dropdownParent: $(this).attr('nama-parent'),
            //     minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
            //     ajax: {
            //         url: "{{ route('akun4.searchAkunAll') }}", // URL untuk pencarian
            //         dataType: 'json',
            //         delay: 250, // Delay saat mengetik (ms)
            //         data: function(params) {
            //             return {
            //                 q: params.term, // Parameter pencarian
            //             };
            //         },
            //         processResults: function(data) {
            //             return {
            //                 results: data.results, // Format data untuk Select2
            //             };
            //         },
            //         cache: true
            //     },
            // });


            $('.searchAkunAll').each(function() {
                // Ambil nilai atribut 'nama-parent'
                var dropdownParentSelector = $(this).attr('nama-parent');

                // Inisialisasi Select2 dengan dropdownParent yang diambil dari atribut
                if (dropdownParentSelector == '' || dropdownParentSelector == undefined) {
                    $(this).select2({
                        placeholder: 'Cari akun...',
                        minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                        ajax: {
                            url: "{{ route('akun4.searchAkunAll') }}", // URL untuk pencarian
                            dataType: 'json',
                            delay: 250, // Delay saat mengetik (ms)
                            data: function(params) {
                                return {
                                    q: params.term, // Parameter pencarian
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: data.results, // Format data untuk Select2
                                };
                            },
                            cache: true
                        },
                    });
                } else {
                    $(this).select2({
                        placeholder: 'Cari akun...',
                        dropdownParent: $(dropdownParentSelector), // Gunakan nilai atribut sebagai selector
                        minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                        ajax: {
                            url: "{{ route('akun4.searchAkunAll') }}", // URL untuk pencarian
                            dataType: 'json',
                            delay: 250, // Delay saat mengetik (ms)
                            data: function(params) {
                                return {
                                    q: params.term, // Parameter pencarian
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: data.results, // Format data untuk Select2
                                };
                            },
                            cache: true
                        },
                    });
                }

            });


            $('.searchAkunKas').select2({
                placeholder: 'Cari nama kas...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('akun4.searchAkunKas') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchAkunPengeluaran').select2({
                placeholder: 'Cari nama akun pengeluaran...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('akun4.searchAkunPengeluaran') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });


            $('.searchAkunPenerimaan').select2({
                placeholder: 'Cari nama akun penerimaan...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('akun4.searchAkunPenerimaan') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

            $('.searchAkunPiutangKonsumen').select2({
                placeholder: 'Cari nama akun piutang...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('akun4.searchAkunPiutangKonsumen') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });


            $('.searchAkunUtangSupplier').select2({
                placeholder: 'Cari nama akun utang...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('akun4.searchAkunUtangSupplier') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });


            $('.searchAkunUtangEkspedisi').select2({
                placeholder: 'Cari nama akun utang...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('akun4.searchAkunUtangEkspedisi') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

        });


        

        // Fungsi untuk menampilkan hasil di dropdown
        function formatBarang(barang) {
            if (!barang.id) {
                return barang.text;
            }
            var $container = $(
                '<div>' +
                '<div>' + barang.text + '</div>' +
                '<div style="font-size: 12px; color: #888;">' +
                'Kategori: ' + barang.kategori + ' | Stok: ' + barang.stok +
                '</div>' +
                '</div>'
            );
            return $container;
        }

        // Fungsi untuk menampilkan hasil yang dipilih
        function formatBarangSelection(barang) {
            return barang.text; // Hanya tampilkan nama barang saat dipilih
        }
    </script>
</body>

</html>
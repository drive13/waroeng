@extends('template.template')

@section('content')
    {{-- Sweet Alert 2 --}}
        @if ($errors->any())
            <script type="text/javascript">
                window.onload = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        html: '@foreach($errors->all() as $error) - {!! $error !!}<br> @endforeach',
                    })
                }
            </script>
        @endif
        @if ($message = Session::get('success'))
            <script type="text/javascript">
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{!! $message !!}',
                    })
                };
                window.open("http://waroeng.test/receipt/{{ Session::get('id') }}");
            </script>
        @endif
    {{-- Sweet Alert 2 --}}

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Transaksi</h3>
                    <p class="text-subtitle text-muted">
                        Halaman Transaksi Pembelian
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav
                        aria-label="breadcrumb"
                        class="breadcrumb-header float-start float-lg-end"
                    >
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Transaksi</a>
                            </li>
                            <li
                                class="breadcrumb-item active"
                                aria-current="page"
                            >
                                Home
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <form action="/simpan-transaksi" method="POST">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="invoice">Nomor Invoice</label>
                                    <input
                                    type="text"
                                    id="invoice"
                                    class="form-control"
                                    name="invoice"
                                    value="{{ $invoice }}"
                                    readonly
                                    />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Pembelian</label>
                                    <input
                                    type="text"
                                    id="tanggal"
                                    class="form-control"
                                    value="{{ date('j F Y') }}"
                                    name="tanggal"
                                    readonly
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pembeli">Pembeli</label>
                                    <select id="pembeli" name="pembeli_id" class="form-select select-pembeli">
                                        @foreach ($pembelis as $pembeli)
                                            <option value="{{ $pembeli->id }}">{{ $pembeli->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <div class="position-relative mt-4">
                                        <button type="button" class="btn btn-info add-buyer" data-bs-toggle="modal" data-bs-target="#modalTambahPembeli"><i class="bi bi-person-plus-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <h4>Detail Barang</h4>
                                <form class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nama-barang">Nama Barang</label>
                                                    <div class="position-relative">
                                                        {{-- <input class="form-control" type="text" name="" id="nama-barang" readonly> --}}
                                                        <select class="form-select" name="" id="nama-barang">
                                                            <option value="" disabled selected>-- Cari Barang-- </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="select-kode">Kode Barang</label>
                                                    <div class="position-relative">
                                                        <input
                                                        type="number"
                                                        class="form-control"
                                                        placeholder="Masukan kode barang"
                                                        id="search-kode"
                                                        autofocus
                                                        />
                                                    </div>
                                                    <input type="hidden" id="id-barang">
                                                </div>
                                            </div>
                                            {{-- versi cari lewat nama barang gk perlu pake tombol cari --}}
                                            {{-- <div class="col-2 text-center">
                                                <div class="form-group">
                                                    <div class="position-relative mt-4">
                                                        <button type="button" class="btn btn-info cari-btn"><i class="bi bi-search"></i></button>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="harga-modal">Harga Modal (Rp.)</label>
                                                    <div class="position-relative">
                                                        <input class="form-control" type="number" name="" id="harga-modal" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="harga-jual">Harga Jual (Rp.)</label>
                                                    <div class="position-relative">
                                                        <input class="form-control" type="number" name="" id="harga-jual">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="qty-barang">Qty</label>
                                                    <div class="position-relative">
                                                        <input class="form-control" type="number" name="" id="qty-barang">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="qty-barang">Foto</label>
                                                    <div class="position-relative">
                                                        <img id="foto-barang" class="img-fluid img-thumbnail" src="images/foto_barang/photo.png" alt="Foto Barang" style="max-height: 100px; max-height:100px;object-fit:contain;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button
                                                type="button"
                                                class="btn btn-primary me-1 mb-1 btn-tambah"
                                                >
                                                Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8 col-12">
                                <h4>Daftar Belanja</h4>
                                <div class="table-responsive rounded border mt-4">
                                    <table class="table table-striped table-transaksi tabel-transaksi">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Kode</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Harga (Rp.)</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Sub Total (Rp.)</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-8 text-end mt-1">
                                            <h5>Total Belanja Rp. </h5>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="total_belanja" readonly>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-8 text-end mt-1">
                                            <h5>Total Bayar Rp. </h5>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control uang-bayar" name="total_bayar">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-8 text-end mt-1">
                                            <h5>Kembalian Rp. </h5>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="kembalian">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <textarea
                                                    class="form-control"
                                                    placeholder="Keterangan"
                                                    id="keterangan"
                                                    name="keterangan"
                                                ></textarea>
                                                <label for="keterangan">Keterangan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-end mt-1">
                                            {{-- <a class="btn btn-success checkout" href="#">Simpan Transaksi</a> --}}
                                            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <!-- Modal Pembeli-->
        <div
            class="modal fade"
            id="modalTambahPembeli"
            tabindex="-1"
            aria-labelledby="labelPembeliBaru"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="#">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="labelPembeliBaru">
                                Tambah Pembeli Baru
                            </h1>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="pembeli_baru" class="form-label">Nama Pembeli</label>
                                        <input type="text" id="pembeli_baru" class="form-control" placeholder="Nama Pembeli" name="nama"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary tambah-pembeli">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Modal Pembeli End -->
@endsection

@push('link')
    <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&display=swap" rel="stylesheet">
@endpush

@push('js')
    <script src="assets/extensions/jquery/jquery.min.js"></script>

    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/pages/sweetalert2.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            const barangs = {{ Js::from($barangs) }};
            // console.log(barangs);
            //versi cari nama
            $.each(barangs, function(i, v){
                let newOption = new Option(v.nama, v.id, false, false);
                $('#nama-barang').append(newOption).trigger('change');
            });

            $('#nama-barang').on('change', function(){
                let selected = $('#nama-barang').select2('data');
                let res = barangs.find(({id}) => id == selected[0].id);
                if (res == undefined) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Barang Tidak Ditemukan!',
                    })
                } else {
                    console.log(res);
                    previewSrc = res.foto;
                    previewTitleSrc = res.nama;
                    $('#id-barang').val(res.id);
                    $('#qty-barang').val('');
                    $('#search-kode').val(res.kode);
                    // $('#nama-barang').val(res.nama);
                    $('#harga-modal').val(res.modal);
                    $('#harga-jual').val(res.harga_jual);
                    $('#foto-barang').attr('src', '/images/foto_barang/' + res.foto);
                }
            });

            let previewSrc = 'photo.png';
            let previewTitleSrc = '';

            $('.select-pembeli').select2();
            $('#nama-barang').select2();

            function subTot(){
                let array = $('.table-transaksi tbody tr').find('td:nth-child(6)').map(function(){
                        return $(this).text()
                    }).get();

                let convert = array.map(Number);
                
                let subTotal = convert.reduce((a, b) => a + b, 0);

                $('input[name="total_belanja"]').val(subTotal);
                
                return;
            }

            function reNomor(){
                let rowCount = $('.tabel-transaksi tbody tr').length;
                let rows = $('.tabel-transaksi tbody tr');
                console.log(rowCount);
                if (rowCount > 0) {
                    for (let i = 0; i < rowCount; i++) {
                        rows.eq(i).find('td:nth-child(1)').text(i+1);
                    }
                }
                return;
            }
            
            $('.table-transaksi').on('click', function(){
                subTot();
            });

            //versi cari dari kode
            $('.cari-btn').on('click', function(){
                let kodeBarang = $('#search-kode').val();
                let res = barangs.find(({kode}) => kode == kodeBarang);
                if (res == undefined) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Barang Tidak Ditemukan!',
                    })
                } else {
                    previewSrc = res.foto;
                    previewTitleSrc = res.nama;
                    $('#id-barang').val(res.id);
                    $('#qty-barang').val('');
                    $('#nama-barang').val(res.nama);
                    $('#harga-modal').val(res.modal);
                    $('#harga-jual').val(res.harga_jual);
                    $('#foto-barang').attr('src', '/images/foto_barang/' + res.foto);
                }
            })

            $('#foto-barang').on('click', function(){
                Swal.fire({
                    title: previewTitleSrc,
                    imageUrl: '/images/foto_barang/' + previewSrc,
                    imageAlt: 'Foto Barang',
                })
            });

            $('.btn-tambah').on('click', function(){
                if ($('#qty-barang').val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Anda belum memasukan jumlah barang yang dibeli!',
                    })
                } else {
                    id = $('#id-barang').val();
                    kodeBarang = $('#search-kode').val();
                    namaBarang = $('#nama-barang').val();
                    hargaBarang = $('#harga-jual').val();
                    modalBarang= $('#harga-modal').val();
                    qty = $('#qty-barang').val();
                    console.log(id);
                    row = $('.tabel-transaksi tbody').children().length;
                    markup = `<tr>
                                <td class="text-center">${row+1}</td>
                                <td class="text-center">
                                    <input type="hidden" name="barang_id[]" value="${id}"><input class="form-select" name="kode[]" type="number" readonly value="${kodeBarang}">
                                </td>
                                <td class="text-center">${namaBarang}</td>
                                <td class="text-center"><input type="hidden" name="modal[]" value="${modalBarang}"><input type="number" class="form-select" name="harga_jual[]" value="${hargaBarang}" readonly></td>
                                <td class="text-center">
                                    <input class="form-select qty" name="qty[]" type="number" min="1" max="100" value="${qty}">
                                </td>
                                <td class="text-center">${hargaBarang * qty}</td>
                                <td class="text-center align-middle"><a href="#" class="btn btn-danger remove-barang"><i class="bi bi-x-square"></i></a></td>
                            </tr>`
    
                    $('.table-transaksi tbody:last-child').append(markup);
                    $('#search-kode').val('');
                    $('#nama-barang').val('');
                    $('#harga-jual').val('');
                    $('#harga-modal').val('');
                    $('#qty-barang').val('');
                    $('#id-barang').val('');
                    subTot();
                }
            });

            $('.tabel-transaksi').on('click', '.remove-barang', function(){
                $(this).closest('tr').remove();
                subTot();
                reNomor();
            });

            $('.tabel-transaksi').on('input', '.qty', function(){
                let qty = $(this).val();
                let harga = $(this).parent().parent().find('td:nth-child(4)').find('input[name="harga_jual[]"]').val();
                
                $(this).parent().parent().find('td:nth-child(6)').text(qty * harga);
                subTot();
            })

            $('.tambah-pembeli').on('click', function(e){
                e.preventDefault();
                let nama = $('#pembeli_baru').val();
                let hutang = 0;

                $.ajax({
                    type:'POST',
                    url:'/new-pembeli',
                    dataType: 'json',
                    data:{
                        _token:"{{csrf_token()}}",
                        nama:nama,
                        hutang:hutang,
                    },
                    success:function(data){
                        let dataOpt = {
                            id: data.id,
                            text: data.nama,
                        };

                        let newOption = new Option(dataOpt.text, dataOpt.id, true, true);
                        $('.select-pembeli').append(newOption).trigger('change'); 
                        $('#modalTambahPembeli').modal('toggle');
                        $('#pembeli_baru').val('');
                    }
                });
            });

            $('.uang-bayar').on('input', function(){
                belanja = $('input[name="total_belanja"]').val();
                bayar = $('input[name="total_bayar"]').val();
                $('input[name="kembalian"]').val(bayar - belanja);
            });

            // $('.save').on('click', function(){
            //     setTimeout(() => {
            //         location.reload();
            //     }, 1000);
            // });

            //jadinya pake cara normal aja.. halaman kosong di tampilin baru di print
            // $('.checkout').on('click', function(e){
            //     e.preventDefault();
            //     invoice = $('input[name="invoice"]').val();
            //     pembeli_id = $('.select-pembeli').val();
            //     tanggal = $('input[name="tanggal"]').val();
            //     total_belanja = $('input[name="total_belanja"]').val();
            //     total_bayar = $('input[name="total_bayar"]').val();
            //     keterangan = $('#keterangan').val();
            //     kode = $('input[name="kode[]"]').map(function(){return $(this).val();}).get();
            //     barang_id = $('input[name="barang_id[]"]').map(function(){return $(this).val();}).get();
            //     qty = $('input[name="qty[]"]').map(function(){return $(this).val();}).get();
            //     modal = $('input[name="modal[]"]').map(function(){return $(this).val();}).get();
            //     harga_jual = $('input[name="harga_jual[]"]').map(function(){return $(this).val();}).get();
            //     harga_sub = $('.table-transaksi tbody tr').find('td:nth-child(6)').map(function(){return $(this).text()}).get();
            //     console.log(invoice, kode, pembeli_id, tanggal, total_bayar, total_belanja, keterangan, barang_id, qty, modal, harga_jual, harga_sub)

            //     $.ajax({
            //         type:'POST',
            //         url:'/simpan-transaksi',
            //         dataType: 'json',
            //         data:{
            //             _token:"{{csrf_token()}}",
            //             invoice:invoice,
            //             pembeli_id:pembeli_id,
            //             tanggal:tanggal,
            //             total_belanja:total_belanja,
            //             total_bayar:total_bayar,
            //             keterangan:keterangan,
            //             barang_id:barang_id,
            //             kode:kode,
            //             qty:qty,
            //         },
            //         success:function(res){
            //             console.log(res);
            //         },
            //         error:function(xhr, status, error) {
            //             var err = JSON.parse(xhr.responseText);
            //             console.log('error '+err.error);
            //         }
            //     });
            // });
        });
    </script>
@endpush

@push('css')
    <style>
        .select2-container .select2-selection--single{
            height: 38px !important; 
        }

        .select2 {
            width:100%!important;
        }

        .table.table-sm tr th{
            padding: 2px;
        }
        
        /* body.theme-dark .table.table-sm tr th{
            padding: 2px !important;
        } */

        .receipt-modal{
            font-family: 'Inconsolata', monospace;
        }
    </style>
@endpush
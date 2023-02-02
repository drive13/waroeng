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
                }
            </script>
        @endif
    {{-- Sweet Alert 2 --}}
    
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Barang</h3>
                    {{-- <p class="text-subtitle text-muted"></p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav
                        aria-label="breadcrumb"
                        class="breadcrumb-header float-start float-lg-end"
                    >
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">{{ $title }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Home
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Info Barang</h4>
                </div>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam,
                    commodi? Ullam quaerat similique iusto temporibus, vero aliquam
                    praesentium, odit deserunt eaque nihil saepe hic deleniti?
                    Placeat delectus quibusdam ratione ullam!
                </div>
            </div>

            <div class="card">
                <div class="card-header ">
                    <div class="d-flex justify-content-between">
                        <h5>Daftar Barang</h5>
                        <!-- Button trigger modal -->
                        <button
                            id="tambahBarang"
                            type="button"
                            class="btn btn-sm btn-success "
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambahBarang"
                        >
                            <i class="bi bi-plus-square align-self-auto"></i> Tambah Barang
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-center">Modal (Rp.)</th>
                                    <th class="text-center">Harga (Rp.)</th>
                                    <th class="text-center">Stock (Pcs)</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $no => $barang)
                                <tr>
                                    <td class="text-center">{{ $no+1 }}</td>
                                    <td class="text-center">{{ $barang->kode }}</td>
                                    <td class="text-center">{{ $barang->nama }}</td>
                                    <td class="text-center">
                                        {{ $barang->kategori->kategori }}
                                    </td>
                                    <td class="text-center">
                                        {{ $barang->tipe->tipe }}
                                    </td>
                                    <td class="text-center">
                                        Rp. {{ $barang->modal }}
                                    </td>
                                    <td class="text-center">
                                        Rp. {{ $barang->harga_jual }}
                                    </td>
                                    <td class="text-center">
                                        {{ $barang->stock }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
        <div
            class="modal fade"
            id="modalTambahBarang"
            tabindex="-1"
            aria-labelledby="labelModalBarang"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-modal" class="form" action="" method="POST" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="labelModalBarang">
                                . . .
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
                                    <div class="form-group mandatory">
                                        <label for="kode" class="form-label">Kode Barang</label>
                                        <input type="number" id="kode" class="form-control" placeholder="Kode Barang. Contoh : 848887555421" name="kode" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mandatory">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select id="kategori" class="choices form-select" name="kategori_id">
                                            {{-- <option value="" selected disabled>-- Kategori Barang --</option> --}}
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mandatory">
                                        <label for="tipe-dagang" class="form-label">Tipe Dagangan</label>
                                        <select id="tipe-dagang" class="choices form-select" name="tipe_dagangan_id">
                                            {{-- <option value="" selected disabled>-- Kategori Barang --</option> --}}
                                            @foreach ($tipeDagangans as $tipe)
                                                <option value="{{ $tipe->id }}">{{ $tipe->tipe }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mandatory">
                                        <label for="nama" class="form-label">Nama Barang</label>
                                        <input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mandatory">
                                        <label for="stock" class="form-label">Stock (Pcs)</label>
                                        <input type="number" min="1" max="999" id="stock" class="form-control" placeholder="Stock (Pcs)" name="stock" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mandatory">
                                        <label for="modal" class="form-label">Modal (Rp.)</label>
                                        <input type="number" id="modal" class="form-control" placeholder="Modal Beli" name="modal" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mandatory">
                                        <label for="harga_jual" class="form-label">Harga Jual (Rp.)</label>
                                        <input type="number" id="harga_jual" class="form-control" placeholder="Harga Jual" name="harga_jual" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="foto" class="form-label">Foto Barang</label>
                                        <div class="input-group mb-3">
                                            <input
                                                id="foto"
                                                name="foto"
                                                type="file"
                                                class="form-control"
                                                accept="image/png, image/jpeg, image/jpg,"
                                                data-parsley-required="true"
                                            />
                                        </div>
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
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Modal End -->
@endsection 

@push('link')
    <link rel="stylesheet" href="assets/css/pages/fontawesome.css" />
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="assets/css/pages/datatables.css" />

    <link rel="stylesheet" href="assets/extensions/choices.js/public/assets/styles/choices.css"/>

    <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css"/>
@endpush 

@push('css') 

@endpush 

@push('js')
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/pages/datatables.js"></script>

    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="assets/js/pages/parsley.js"></script>

    <script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="assets/js/pages/form-element-select.js"></script>

    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/pages/sweetalert2.js"></script>

    <script>
        $(function(){
            $('#tambahBarang').on('click', function() {
                $('#labelModalBarang').html('Tambah Barang');
                $('#formModal').append('<input type="hidden" name="_method" value="POST">');
                $('#kode').val('');
                $('#kategori_id').val('');
                $('#tipe_dagangan_id').val('');
                $('#nama').val('');
                $('#modal').val('');
                $('#harga_jual').val('');
                $('#stock').val('');
                $('.modal-footer button[type=submit]').html('Simpan');
                $('.modal-content form').attr('action', '/barangs');
            })
            $('.editProduct').on('click', function() {
                const id = $(this).data('id');
                // // console.log(id);
                
                // $('#modalProductLabel').html('Edit Product');
                // $('#formModal').append('<input type="hidden" name="_method" value="PATCH">');
                // $('.modal-footer button[type=submit]').html('Save Changes');
                // $('.modal-content form').attr('action', '/product/' + id);
                // $.ajax({
                //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                //     url:'/ajax-product',
                //     data: {id : id},
                //     method: 'get',
                //     dataType: 'json',
                //     success: function(product){
                //         console.log(product);
                //         $('#product').val(product.product);
                //         $('#code_product').val(product.code_product);
                //         $('#price').val(product.price);
                //         $('#stock').val(product.stock);
                //     }
                // })
            })
        })
    </script>
@endpush

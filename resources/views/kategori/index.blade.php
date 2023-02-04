@extends('template.template') 

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Kategori</h3>
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
                    <h4 class="card-title">Info Kategori</h4>
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
                        <h5>Daftar Kategori</h5>
                        <!-- Button trigger modal -->
                        <button
                            id="tambahBarang"
                            type="button"
                            class="btn btn-sm btn-success "
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambahBarang"
                        >
                            <i class="bi bi-plus-square align-self-auto"></i> Tambah Kategori
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Jumlah Barang</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $no => $kategori)
                                <tr>
                                    <td class="text-center">{{ $no+1 }}</td>
                                    <td class="text-center">{{ $kategori->kategori }}</td>
                                    <td class="text-center">{{ $kategori->barangs_count }} Barang</td>
                                    <td class="text-center">
                                        {{ $kategori->keterangan }}
                                    </td>
                                    <td>
                                        <a href="/kategoris/{{ $kategori->id }}/edit" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
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
                                        <label for="kategori" class="form-label">Nama Kategori</label>
                                        <input type="text" id="kategori" class="form-control" placeholder="Nama Barang" name="kategori" data-parsley-required="true"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="keterangan" class="form-label">Kategori</label>
                                        <input type="text" id="keterangan" class="form-control" placeholder="Nama Barang" name="keterangan" data-parsley-required="false"/>
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
@endpush

@push('js')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>

    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>

    <script>
        $(document).ready(function(){
            $('#tambahBarang').on('click', function() {
                $('#labelModalBarang').html('Tambah Kategori');
                $('#formModal').append('<input type="hidden" name="_method" value="POST">');
                $('#kategori').val('');
                $('#keterangan').val('');
                $('.modal-footer button[type=submit]').html('Simpan');
                $('.modal-content form').attr('action', '/kategoris');
            })
        })
    </script>
@endpush

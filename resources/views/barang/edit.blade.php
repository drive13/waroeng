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
            </script>
        @endif
    {{-- Sweet Alert 2 --}}

    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Barang</h3>
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
                    <h4 class="card-title">Edit Barang</h4>
                </div>
                <div class="card-body">
                    <form id="form-modal" class="form" action="/barangs/{{ $barang->id }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mandatory">
                                    <label for="kode" class="form-label">Kode Barang</label>
                                    <input type="number" id="kode" class="form-control" value="{{ $barang->kode }}" name="kode" readonly data-parsley-required="true"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mandatory">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select id="kategori" class="form-select" name="kategori_id">
                                        {{-- <option value="" selected disabled>-- Kategori Barang --</option> --}}
                                        @foreach ($kategoris as $kategori)
                                            @if($barang->kategori_id == $kategori->id)
                                                <option value="{{ $kategori->id }}" selected>{{ $kategori->kategori }}</option>
                                            @else
                                                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mandatory">
                                    <label for="tipe-dagang" class="form-label">Tipe Dagangan</label>
                                    <select id="tipe-dagang" class="form-select" name="tipe_dagangan_id">
                                        {{-- <option value="" selected disabled>-- Kategori Barang --</option> --}}
                                        @foreach ($tipeDagangans as $tipe)
                                            @if($barang->tipe_dagangan_id == $tipe->id)
                                                <option value="{{ $tipe->id }}">{{ $tipe->tipe }}</option>
                                            @else
                                                <option value="{{ $tipe->id }}">{{ $tipe->tipe }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mandatory">
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input type="text" id="nama" class="form-control" value="{{ $barang->nama }}" name="nama" data-parsley-required="true"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mandatory">
                                    <label for="stock" class="form-label">Stock (Pcs)</label>
                                    <input type="number" min="1" max="999" id="stock" class="form-control" value="{{ $barang->stock }}" name="stock" data-parsley-required="true"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mandatory">
                                    <label for="modal" class="form-label">Modal (Rp.)</label>
                                    <input type="number" id="modal" class="form-control" value="{{ $barang->modal }}" name="modal" data-parsley-required="true"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mandatory">
                                    <label for="harga_jual" class="form-label">Harga Jual (Rp.)</label>
                                    <input type="number" id="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" name="harga_jual" data-parsley-required="true"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mandatory">
                                    <label for="foto" class="form-label">Foto Barang</label>
                                    <img class=" form-control mb-2 img-fluid img-thumbnail" src="/images/foto_barang/{{ $barang->foto }}" alt="Foto Barang" style="max-width: 200px;">
                                    <div class="input-group mb-3">
                                        <input
                                            id="foto"
                                            name="foto"
                                            type="file"
                                            class="form-control"
                                            accept="image/png, image/jpeg, image/jpg,"
                                            data-parsley-required="false"
                                        />
                                        <input type="hidden" name="foto_lama" value="{{ $barang->foto }}" accept="image/png, image/jpeg, image/jpg,">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <style>
        .select2-container .select2-selection--single{
            height: 38px !important; 
        }

        .select2 {
            width:100%!important;
        }

        body.theme-dark .table.table-sm tr th{
            padding: 2px !important;
        }

        body.theme-dark ul{
            padding-left: 0 !important;
        }
    </style>
@endpush

@push('link')
    <link rel="stylesheet" href="/assets/extensions/sweetalert2/sweetalert2.min.css"/>    

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="/assets/js/pages/sweetalert2.js"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
        $(document).ready(function(){
            $('#kategori').select2();
            $('#tipe-dagang').select2();
        });
    </script>
@endpush
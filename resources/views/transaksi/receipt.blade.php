<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name') }} - {{ $title }}</title>
        <link rel="stylesheet" href="/assets/css/main/app.css" />
        <link rel="stylesheet" href="/assets/css/main/app-dark.css" />
        <link
            rel="shortcut icon"
            href="/assets/images/logo/favicon.svg"
            type="image/x-icon"
        />
        <link
            rel="shortcut icon"
            href="/assets/images/logo/favicon.png"
            type="image/png"
        />


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&display=swap" rel="stylesheet">

        <style>
            .receipt{
                font-family: 'Inconsolata', monospace;
            }

            .table.table-sm tr th{
                padding: 2px;
            }

            .receipt-text{
                color: #607080 !important;
            }
        </style>
    </head>

    <body>
        <script src="/assets/js/initTheme.js"></script>
        {{-- <nav class="navbar navbar-light">
            <div class="container d-block">
                <a href="index.html"><i class="bi bi-chevron-left"></i></a>
                <a class="navbar-brand ms-4" href="index.html">
                    <img src="/assets/images/logo/logo.svg" />
                </a>
            </div>
        </nav> --}}
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="card mt-4">
                        <div class="card-body receipt">
                            <div class="row text-center">
                                <div class="col">
                                    <h1 class="receipt-text" style="height: 40px;">Toko Kalimas</h1>
                                    <h6 class="receipt-text" style="height: 10px;">Kp. Babakan Tarikolot</h6>
                                    <h6 class="receipt-text" style="height: 10px;">Telp: 081266669999</h6>
                                </div>
                            </div>
                            <div class="row mt-4" style="height: 20px;">
                                <div class="col h-25">
                                    <h6 class="receipt-text">No Invoice :<span class="receipt-invoice"></span></h6>
                                </div>
                            </div>
                            <div class="row" style="height: 20px;">
                                <div class="col">
                                    <h6 class="receipt-text">Tanggal :<span class="receipt-tanggal"></span></h6>
                                </div>
                            </div>
                            <div class="row" style="height: 20px;">
                                <div class="col">
                                    <h6 class="receipt-text">Pembeli :<span class="receipt-pembeli"></span></h6>
                                </div>
                            </div>
                            {{-- 
                                <div class="row">
                                    <label for="receipt-invoice" class="col-md-2 col-form-label">No Invoice</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control-plaintext" id="receipt-invoice" value="xxxxxxxxx">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="receipt-tanggal" class="col-md-2 col-form-label">Tanggal</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control-plaintext" id="receipt-tanggal" value="xxxxxxxxx">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="receipt-pembeli" class="col-md-2 col-form-label">Pembeli</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control-plaintext" id="receipt-pembeli" value="xxxxxxxxx">
                                    </div>
                                </div> 
                            --}}
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless receipt-table border-bottom border-top border-2">
                                            <thead class="border-bottom">
                                                <tr>
                                                    <th class="text-start">No</th>
                                                    <th class="text-start" colspan="2">Nama Barang</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-end" colspan="2">Qty</th>
                                                    <th class="text-center">Harga Satuan</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody class="receipt-body">
                                            </tbody>
                                            <tfoot class="border-top receipt-foot">
                                                <tr>
                                                    <th class="text-end" colspan="3">Total Belanja</th>
                                                    <th class="text-center receipt-tot-belanja"></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-end" colspan="3">Total Bayar</th>
                                                    <th class="text-center receipt-tot-bayar"></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-end" colspan="3">Kembali</th>
                                                    <th class="text-center receipt-kembali-kurang"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h4 class="receipt-text" style="font-weight: 600;">Terima kasih telah berbelanja di Waroeng!</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/js/app.js"></script>
        <script src="/assets/extensions/jquery/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                function titik(number) {
                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
                const receipt = {{ Js::from($data) }};
                // console.log(receipt);
                $('.receipt-invoice').text(receipt.invoice);
                $('.receipt-tanggal').text(receipt.tanggal);
                $('.receipt-pembeli').text(receipt.pembeli.nama);
                $('.receipt-tot-belanja').text(titik(receipt.total_belanja));
                $('.receipt-tot-bayar').text(titik(receipt.total_bayar));
                $('.receipt-kembali-kurang').text(titik(receipt.total_bayar - receipt.total_belanja));
                
                $.each(receipt.details, function(i, v){
                    // console.log(v)
                    $('.receipt-body').append(
                        `<tr>
                            <th class="text-start">${i+1}</th>
                            <th class="text-start" colspan="2">${receipt.details[i].barang.nama}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="text-end" colspan="2">${receipt.details[i].qty}</th>
                            <th class="text-center">${titik(receipt.details[i].harga_jual)}</th>
                            <th class="text-center">${titik(receipt.details[i].harga_total)}</th>
                        </tr>`
                    );
                });

                $('.receipt').on('click', function(){
                    window.print();
                });

            });
        </script>
    </body>
</html>

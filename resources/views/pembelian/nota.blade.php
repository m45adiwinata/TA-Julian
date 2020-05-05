<html>
    <head>
        <title>Alam Indah Utama | Nota #{{$pembelian->id}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            /* table tr td {border:1px solid black;} */
        </style>
    </head>
    <body>
        <h1 style="text-align:center;">NOTA PEMBELIAN</h1>
        <table>
            <tbody>
                <tr>
                    <td style="width:450px;"><b style="font-size:30px;"> </b></td>
                    <td>Tanggal pembelian: {{$pembelian->tanggal_str}}</td>
                </tr>
                <tr>
                    <td><b style="font-size:25px;">Suplier:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b style="font-size:20px;">{{$pembelian->suplier()->first()->nama}}</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{$pembelian->suplier()->first()->alamat}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{$pembelian->suplier()->first()->no_telp}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{$pembelian->suplier()->first()->contact_person}}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Description</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Cost</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total=0; @endphp
                @foreach($pembelian->barangPembelian()->get() as $key => $bp)
                <tr>
                    <td scope="row">{{$key+1}}</td>
                    <td>{{$bp->barang()->first()->nama}}</td>
                    <td>{{intval($bp->harga_beli/$bp->barang()->first()->harga)}}</td>
                    <td>Rp {{number_format($bp->barang()->first()->harga, 2, ',', '.')}}</td>
                    <td>Rp {{number_format($bp->harga_beli, 2, ',', '.')}}</td>
                </tr>
                @php $total += $bp->harga_beli; @endphp
                @endforeach
                <tr>
                    <td colspan="4"><b>DISKON</b></td>
                    <td>
                    @php
                    if($pembelian->type_diskon_id == 0) {
                        $diskon = $pembelian->diskon;
                    }
                    else {
                        $diskon = $pembelian->diskon * $total / 100;
                    }
                    echo('Rp '.number_format($diskon, 2, ',', '.'));
                    @endphp
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><b>TOTAL</b></td>
                    <td>Rp {{number_format($total, 2, ',', '.')}}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
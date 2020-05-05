<html>
    <head>
        <title>Alam Indah Utama | Nota #{{$penjualan->id}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            /* table tr td {border:1px solid black;} */
        </style>
    </head>
    <body>
        <h1 style="text-align:center;">NOTA PENJUALAN</h1>
        <table>
            <tbody>
                <tr>
                    <td style="width:250px;"><b style="font-size:30px;"> </b></td>
                    <td style="width:210px;"> </td>
                    <td>Tanggal Penjualan: {{$penjualan->tanggal_str}}</td>
                </tr>
                <tr>
                    <td><b style="font-size:25px;">Pelanggan:</b></td>
                    <td><b style="font-size:25px;">Sales:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b style="font-size:20px;">{{$penjualan->pelanggan()->first()->nama}}</b></td>
                    <td><b style="font-size:20px;">{{$penjualan->sales()->first()->nama}}</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{$penjualan->pelanggan()->first()->alamat}}</td>
                    <td>{{$penjualan->sales()->first()->alamat}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{$penjualan->pelanggan()->first()->no_telp}}</td>
                    <td>{{$penjualan->sales()->first()->no_telp}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{$penjualan->pelanggan()->first()->contact_person}}</td>
                    <td></td>
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
                @foreach($penjualan->barangPenjualan()->get() as $key => $bp)
                <tr>
                    <td scope="row">{{$key+1}}</td>
                    <td>{{$bp->barang()->first()->nama}}</td>
                    <td>{{intval($bp->harga_jual/$bp->barang()->first()->harga_jual)}}</td>
                    <td>Rp {{number_format($bp->barang()->first()->harga_jual, 2, ',', '.')}}</td>
                    <td>Rp {{number_format($bp->harga_jual, 2, ',', '.')}}</td>
                </tr>
                @php $total += $bp->harga_jual; @endphp
                @endforeach
                <tr>
                    <td colspan="4"><b>DISKON</b></td>
                    <td>
                    @php
                    if($penjualan->type_diskon == 0) {
                        $diskon = $penjualan->diskon;
                    }
                    else {
                        $diskon = $penjualan->diskon * $total / 100;
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
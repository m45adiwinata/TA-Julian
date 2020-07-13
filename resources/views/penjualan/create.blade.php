@extends('layout')
@section('content')
<div class="page-container">
    @include('sidebar')
    <!-- main content area start -->
    <div class="main-content">
        
        <!-- header area start -->
        <div class="header-area">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="search-box pull-left">
                        <form action="#">
                            <input type="text" name="search" placeholder="Search..." required>
                            <i class="ti-search"></i>
                        </form>
                    </div>
                </div>
                <!-- profile info & task notification -->
                <div class="col-md-6 col-sm-4 clearfix">
                    <ul class="notification-area pull-right">
                        <li id="full-view"><i class="ti-fullscreen"></i></li>
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- header area end -->
        @include('titlebar')
        @if(session()->get('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}  
        </div>
        @endif
        <div class="main-content-inner">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <form method="POST" action="{{route('penjualan.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="invoice-area">
                                    <div class="invoice-head">
                                        <div class="row">
                                            <div class="iv-left col-6">
                                                <span>PENJUALAN</span>
                                            </div>
                                            <div class="iv-right col-6 text-md-right">
                                                <span>#{{$new_id}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="invoice-address">
                                                <h3>penjualan kepada</h3>
                                                <div class="form-group">
                                                    <select class="form-control" name="pelanggan_id" id="pelanggan">
                                                        <option selected="selected" disabled="disabled">Pelanggan...</option>
                                                        @foreach($pelanggans as $pelanggan)
                                                        <option value="{{$pelanggan->id}}">{{$pelanggan->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="sales_id" id="sales">
                                                        <option selected="selected" disabled="disabled">Sales...</option>
                                                        @foreach($saleses as $sales)
                                                        <option value="{{$sales->id}}">{{$sales->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h3>Pelanggan</h3>
                                                        <h5 id="nama-pelanggan"></h5>
                                                        <p id="alamat-pelanggan"></p>
                                                        <p id="no_telpon-pelanggan"></p>
                                                        <p id="contact_person-pelanggan"></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h3>Sales</h3>
                                                        <h5 id="nama-sales"></h5>
                                                        <p id="alamat-sales"></p>
                                                        <p id="no_telpon-sales"></p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <ul class="invoice-date">
                                                <li>Tanggal : <input type="date" name="date"></li>
                                                <li>Jam : <input type="time" name="time" value="{{date('H:i')}}"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invoice-table table-responsive mt-5">
                                        <table class="table table-bordered table-hover text-right">
                                            <thead>
                                                <tr class="text-capitalize">
                                                    <th class="text-left" style="width: 40%; min-width: 130px;">description</th>
                                                    <th class="text-center">qty</th>
                                                    <th class="text-center" style="min-width: 100px">Unit Cost</th>
                                                    <th class="text-center">total</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="barangs">
                                                <tr id="row-barang-0">
                                                    <td class="text-left">
                                                        <select name="barang[0]" id="barang-0" style="width:100%;" onchange="setBarang(0)">
                                                            <option disabled="disabled" selected="selected">Barang...</option>
                                                            @foreach($barangs as $barang)
                                                            <option value="{{$barang->id}}">{{$barang->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center"><input type="number" value="1" name="qty[0]" style="width:50px;" id="qty-0" onchange="onChangeQty(0)"></td>
                                                    <td id="uc-0"></td>
                                                    <td id="total-0"></td>
                                                    <td onclick="hapusRow(0)">del</td>
                                                </tr>
                                                <tr id="barang-new">
                                                    <td colspan="5" class="text-center" onclick="tambahRow()">ADD</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <input class="form-control" placeholder="Diskon..." type="number" name="diskon" id="diskon">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" name="type_diskon" id="type_diskon">
                                                                <option value="0">Jumlah</option>
                                                                <option value="1">Persen</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>total cost :</td>
                                                    <td colspan="2">Rp <span id="total-cost">0</span></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="invoice-buttons text-right">
                                    <!-- <a href="#" class="invoice-btn">print invoice</a> -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var jmlBarang = 1;
    var tempBarang = [];
    var totalCost = 0;
    var rowTotalHarga = [];
    var diskon;
    $(document).ready(function() {
        $('#pelanggan').select2();
        $('#pelanggan').change(function() {
            $.get('/penjualan/get-pelanggan/' + $(this).val(), function(data) {
                $('#nama-pelanggan').html(data.nama);
                $('#alamat-pelanggan').html(data.alamat);
                $('#no_telpon-pelanggan').html(data.no_telpon);
                $('#contact_person-pelanggan').html(data.contact_person);
            });
        });
        $('#sales').select2();
        $('#sales').change(function() {
            $.get('/penjualan/get-sales/' + $(this).val(), function(data) {
                $('#nama-sales').html(data.nama);
                $('#alamat-sales').html(data.alamat);
                $('#no_telpon-sales').html(data.no_telpon);
            });
        });
        $('#barang-0').select2();
        $('#type_diskon').select2();
        $('#diskon').change(function() {
            if ($('#diskon').val()) {
                if($('#type_diskon').val() == 0) {
                    diskon = $('#diskon').val();
                }
                else {
                    diskon = totalCost * $('#diskon').val() / 100;
                }
            } else {
                diskon = 0;
            }
            $('#total-cost').html(totalCost - diskon);
        });
        $('#type_diskon').change(function() {
            if ($('#diskon').val()) {
                if($('#type_diskon').val() == 0) {
                    diskon = $('#diskon').val();
                }
                else {
                    diskon = totalCost * $('#diskon').val() / 100;
                }
            } else {
                diskon = 0;
            }
            $('#total-cost').html(totalCost - diskon);
        });
    });
    function setBarang(id) {
        $.get('/pembelian/get-barang/' + $('#barang-'+id).val(), function(data) {
            $('#uc-'+id).html('Rp ' + data.harga_jual);
            $('#total-'+id).html('Rp ' + (data.harga_jual * $('#qty-'+id).val()));
            var found = false;
            var row;
            var n = 0;
            $.each(rowTotalHarga, function(key, value) {
                if(value.id == id) {
                    found = true;
                    row = value;
                    return false;
                }
                n++;
            });
            if(found == false) {
                tempBarang.push(data);
                rowTotalHarga.push(
                    {"id" : id, "total": data.harga_jual * $('#qty-'+id).val()}
                );
            }
            else {
                tempBarang[n] = data;
                row.total = data.harga_jual * $('#qty-'+id).val();
            }
            totalCost = 0;
            $.each(rowTotalHarga, function(key, value) {
                totalCost += value.total;
            });
            if ($('#diskon').val()) {
                if($('#type_diskon').val() == 0) {
                    diskon = $('#diskon').val();
                }
                else {
                    diskon = totalCost * $('#diskon').val() / 100;
                }
            } else {
                diskon = 0;
            }
            $('#total-cost').html(totalCost - diskon);
        });
    }
    function tambahRow() {
        $('#barang-new').remove();
        $('#barangs').append(
            '<tr id="row-barang-'+jmlBarang+'">'+
                '<td class="text-left">'+
                    '<select name="barang['+jmlBarang+']" id="barang-'+jmlBarang+'" style="width:100%;" onchange="setBarang('+jmlBarang+')">'+
                        '<option disabled="disabled" selected="selected">Barang...</option>'+
                        '@foreach($barangs as $barang)'+
                        '<option value="{{$barang->id}}">{{$barang->nama}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td class="text-center"><input type="number" value="1" name="qty['+jmlBarang+']" style="width:50px;" id="qty-'+jmlBarang+'" onchange="onChangeQty('+jmlBarang+')"></td>'+
                '<td id="uc-'+jmlBarang+'"></td>'+
                '<td id="total-'+jmlBarang+'"></td>'+
                '<td onclick="hapusRow('+jmlBarang+')">del</td>'+
            '</tr>'+
            '<tr id="barang-new">'+
                '<td colspan="5" class="text-center" onclick="tambahRow()">ADD</td>'+
            '</tr>'
        );
        $('#barang-'+jmlBarang).select2();
        jmlBarang++;
    }
    function hapusRow(id) {
        $.each(rowTotalHarga, function(key, value) {
            if(value.id == id) {
                rowTotalHarga.splice(key, 1);
                tempBarang.splice(key, 1);
                return false;
            }
        });
        $('#row-barang-'+id).remove();
        totalCost = 0;
        $.each(rowTotalHarga, function(key, value) {
            totalCost += value.total;
        });
        if ($('#diskon').val()) {
            if($('#type_diskon').val() == 0) {
                diskon = $('#diskon').val();
            }
            else {
                diskon = totalCost * $('#diskon').val() / 100;
            }
        } else {
            diskon = 0;
        }
        $('#total-cost').html(totalCost - diskon);
    }
    function onChangeQty(id) {
        if($('#qty-'+id).val() > 0) {
            if($('#barang-'+id).val() != null) {
                var n;
                $.each(rowTotalHarga, function(key, value) {
                    if(value.id == id) {
                        n = key;
                        return false;
                    }
                });
                $('#uc-'+id).html('Rp ' + tempBarang[n].harga_jual);
                $('#total-'+id).html('Rp ' + (tempBarang[n].harga_jual * $('#qty-'+id).val()));
                rowTotalHarga[n].total = tempBarang[n].harga_jual * $('#qty-'+id).val();
            }
            $('#qty-'+id).css('border', '1 px solid black');
        }
        else {
            alert('Kuantitas tidak boleh dibawah 1');
            $('#qty-'+id).css('border', '1px solid red');
        }
        totalCost = 0;
        $.each(rowTotalHarga, function(key, value) {
            totalCost += value.total;
        });
        if ($('#diskon').val()) {
            if($('#type_diskon').val() == 0) {
                diskon = $('#diskon').val();
            }
            else {
                diskon = totalCost * $('#diskon').val() / 100;
            }
        } else {
            diskon = 0;
        }
        $('#total-cost').html(totalCost - diskon);
    }
</script>
@endsection
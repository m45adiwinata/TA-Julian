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
                        <li class="dropdown">
                            <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                <span>2</span>
                            </i>
                            <div class="dropdown-menu bell-notify-box notify-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>3</span></i>
                            <div class="dropdown-menu notify-box nt-enveloper-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('assets/images/author/author-img1.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('assets/images/author/author-img2.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">When you can connect with me...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('assets/images/author/author-img3.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">I missed you so much...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('assets/images/author/author-img4.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Your product is completely Ready...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('assets/images/author/author-img2.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('assets/images/author/author-img1.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('assets/images/author/author-img3.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="settings-btn">
                            <i class="ti-settings"></i>
                        </li>
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
                        <form method="POST" action="{{route('pembelian.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="invoice-area">
                                    <div class="invoice-head">
                                        <div class="row">
                                            <div class="iv-left col-6">
                                                <span>PEMBELIAN</span>
                                            </div>
                                            <div class="iv-right col-6 text-md-right">
                                                <span>#{{$new_id}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="invoice-address">
                                                <h3>pembelian kepada</h3>
                                                <div class="form-group">
                                                    <select class="form-control" name="suplier" id="suplier">
                                                        <option selected="selected" disabled="disabled">Suplier...</option>
                                                        @foreach($supliers as $suplier)
                                                        <option value="{{$suplier->id}}">{{$suplier->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <h5 id="nama-suplier"></h5>
                                                <p id="alamat-suplier"></p>
                                                <p id="no_telpon-suplier"></p>
                                                <p id="contact_person-suplier"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <ul class="invoice-date">
                                                <li>Tanggal Pembelian :
                                                    <input type="date" name="created_at" style="width: 150px;">
                                                </li>
                                                    
                                                <!-- <li>Tanggal Pembelian : {{date('d-m-Y')}}</li> -->
                                                <!-- <li>Due Date : sat 18 | 07 | 2018</li> -->
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
                                                    <th colspan="2" class="text-center">penyimpanan</th>
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
                                                    <td><input type="number" value="1" name="qty[0]" style="width:50px;" id="qty-0" onchange="onChangeQty(0)"></td>
                                                    <td id="uc-0"></td>
                                                    <td id="total-0"></td>
                                                    <td>
                                                        <select name="lokasi[0]" id="lokasi-0" style="width:100%;">
                                                            @foreach($lokasis as $lokasi)
                                                            <option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="sub_lokasi[0]" id="sub_lokasi-0" style="width:100%;">
                                                            @foreach($sub_lokasis as $sub_lokasi)
                                                            <option value="{{$sub_lokasi->id}}">{{$sub_lokasi->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td onclick="hapusRow(0)">del</td>
                                                </tr>
                                                <tr id="barang-new">
                                                    <td colspan="7" class="text-center" onclick="tambahRow()">ADD</td>
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
                                                    <td>Rp <span id="total-cost">0</span></td>
                                                    <td></td>
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
        $('#suplier').select2();
        $('#suplier').change(function() {
            $.get('/pembelian/get-suplier/' + $(this).val(), function(data) {
                $('#nama-suplier').html(data.nama);
                $('#alamat-suplier').html(data.alamat);
                $('#no_telpon-suplier').html(data.no_telpon);
                $('#contact_person-suplier').html(data.contact_person);
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
        $.get('/pembelian/cek-kapasitas-gudang/' + $('#sub_lokasi-0').val(), function(data) {
            if($('#qty-0').val()) {
                if ($('#qty-0').val() > data.sisa) {
                    alert('Sisa kapasitas ' + data.sub_lokasi.nama + ' tidak cukup untuk pembelian unit ini.');
                }
            }
        });
        
    });
    function setBarang(id) {
        $.get('/pembelian/get-barang/' + $('#barang-'+id).val(), function(data) {
            $('#uc-'+id).html('Rp ' + data.harga);
            $('#total-'+id).html('Rp ' + (data.harga * $('#qty-'+id).val()));
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
                    {"id" : id, "total": data.harga * $('#qty-'+id).val()}
                );
            }
            else {
                tempBarang[n] = data;
                row.total = data.harga * $('#qty-'+id).val();
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
                '<td><input type="number" value="1" name="qty['+jmlBarang+']" style="width:50px;" id="qty-'+jmlBarang+'" onchange="onChangeQty('+jmlBarang+')"></td>'+
                '<td id="uc-'+jmlBarang+'"></td>'+
                '<td id="total-'+jmlBarang+'"></td>'+
                '<td>'+
                    '<select name="lokasi['+jmlBarang+']" id="lokasi-'+jmlBarang+'" style="width:100%;">'+
                        '@foreach($lokasis as $lokasi)'+
                        '<option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<select name="sub_lokasi['+jmlBarang+']" id="sub_lokasi-'+jmlBarang+'" style="width:100%;">'+
                        '@foreach($sub_lokasis as $sub_lokasi)'+
                        '<option value="{{$sub_lokasi->id}}">{{$sub_lokasi->nama}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td onclick="hapusRow('+jmlBarang+')">del</td>'+
            '</tr>'+
            '<tr id="barang-new">'+
                '<td colspan="7" class="text-center" onclick="tambahRow()">ADD</td>'+
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
                $.get('/pembelian/cek-kapasitas-gudang/' + $('#sub_lokasi-'+id).val(), function(data) {
                    if ($('#qty-0').val() > data.sisa) {
                        alert('Sisa kapasitas ' + data.sub_lokasi.nama + '('+data.sisa+') tidak cukup untuk pembelian unit ini.');
                    }
                });
                var n;
                $.each(rowTotalHarga, function(key, value) {
                    if(value.id == id) {
                        n = key;
                        return false;
                    }
                });
                $('#uc-'+id).html('Rp ' + tempBarang[n].harga);
                $('#total-'+id).html('Rp ' + (tempBarang[n].harga * $('#qty-'+id).val()));
                rowTotalHarga[n].total = tempBarang[n].harga * $('#qty-'+id).val();
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
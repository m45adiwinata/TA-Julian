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
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Dashboard</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="index.html">Home</a></li>
                            <li><span>Pembelian</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right">
                        <img class="avatar user-thumb" src="{{asset('assets/images/author/avatar.png')}}" alt="avatar">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Kumkum Rai <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Message</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="#">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-area">
                                <div class="invoice-head">
                                    <div class="row">
                                        <div class="iv-left col-6">
                                            <span>PEMBELIAN</span>
                                        </div>
                                        <div class="iv-right col-6 text-md-right">
                                            <span>#34445998</span>
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
                                            <li>Invoice Date : {{date('d-m-Y')}}</li>
                                            <li>Due Date : sat 18 | 07 | 2018</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="invoice-table table-responsive mt-5">
                                    <table class="table table-bordered table-hover text-right">
                                        <thead>
                                            <tr class="text-capitalize">
                                                <th class="text-center" style="width: 5%;">id</th>
                                                <th class="text-left" style="width: 45%; min-width: 130px;">description</th>
                                                <th>qty</th>
                                                <th style="min-width: 100px">Unit Cost</th>
                                                <th>total</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangs">
                                            <tr id="row-barang-1">
                                                <td class="text-center">1</td>
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
                                                <td onclick="hapusRow(1)">del</td>
                                            </tr>
                                            <tr id="barang-new">
                                                <td colspan="6" class="text-center" onclick="tambahRow()">ADD</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">total cost :</td>
                                                <td>Rp 0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-buttons text-right">
                                <a href="#" class="invoice-btn">print invoice</a>
                                <a href="#" class="invoice-btn">send invoice</a>
                            </div>
                        </div>
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
    });
    function setBarang(id) {
        $.get('/pembelian/get-barang/' + $('#barang-'+id).val(), function(data) {
            $('#uc-'+id).html('Rp ' + data.harga);
            $('#total-'+id).html('Rp ' + (data.harga * $('#qty-'+id).val()));
            if(tempBarang.length == id) {
                tempBarang.push(data);
                rowTotalHarga.push(data.harga * $('#qty-'+id).val());
            }
            else {
                tempBarang[id] = data;
                rowTotalHarga[id] = data.harga * $('#qty-'+id).val();
            }
            
        });
    }
    function tambahRow() {
        var temp = jmlBarang + 1;
        $('#barang-new').remove();
        $('#barangs').append(
            '<tr id="row-barang-'+temp+'">'+
                '<td class="text-center">'+(tempBarang.length+1)+'</td>'+
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
                '<td onclick="hapusRow('+temp+')">del</td>'+
            '</tr>'+
            '<tr id="barang-new">'+
                '<td colspan="6" class="text-center" onclick="tambahRow()">ADD</td>'+
            '</tr>'
        );
        $('#barang-'+jmlBarang).select2();
        jmlBarang++;
        rowTotalHarga.push(0);
    }
    function hapusRow(id) {
        let tempTotal = parseInt($('#total-'+(id-1)).html().split(" ")[1]);
        rowTotalHarga.splice(id, 1);
        $('#row-barang-'+id).remove();
    }
    function onChangeQty(id) {
        if($('#barang-'+id).val() != null) {
            $('#uc-'+id).html('Rp ' + tempBarang[id].harga);
            $('#total-'+id).html('Rp ' + (tempBarang[id].harga * $('#qty-'+id).val()));
            rowTotalHarga[id] = tempBarang[id].harga * $('#qty-'+id).val();
        }
    }
</script>
@endsection
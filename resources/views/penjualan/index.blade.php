@extends('layout')
@section('style')
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
@endsection
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
                                            <img src="assets/images/author/author-img1.jpg" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="assets/images/author/author-img2.jpg" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">When you can connect with me...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="assets/images/author/author-img3.jpg" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">I missed you so much...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="assets/images/author/author-img4.jpg" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Your product is completely Ready...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="assets/images/author/author-img2.jpg" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="assets/images/author/author-img1.jpg" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="assets/images/author/author-img3.jpg" alt="image">
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
        <div class="main-content-inner">
            <div class="row">
                <!-- Hoverable Rows Table end -->
                <!-- Progress Table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Progress Table</h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Pelanggan</th>
                                                <th scope="col">Sales</th>
                                                <th scope="col">Barang</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($penjualans as $key => $penjualan)\
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$penjualan->pelanggan()->first()->nama}}</td>
                                                <td>{{$penjualan->sales()->first()->nama}}</td>
                                                <td><span id="lihat" class="status-p bg-primary" onclick="lihatBarang({{$penjualan->id}})">Lihat Barang</span></td>
                                                <td>
                                                    @php $temp = 0;
                                                    foreach($penjualan->barangPenjualan()->get() as $barang) {
                                                        $temp += $barang->harga_jual;
                                                    }
                                                    if($penjualan->type_diskon == 1) {
                                                        $temp -= $temp * $penjualan->diskon / 100;
                                                    }
                                                    else {
                                                        $temp -= $penjualan->diskon;
                                                    }
                                                    @endphp
                                                    {{number_format($temp, 2, ',', '.')}}
                                                </td>
                                                <td>
                                                    <ul class="d-flex justify-content-center">
                                                        <li class="mr-3"><a href="{{route('penjualan.edit', $penjualan->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Progress Table end -->
                <!-- Button trigger modal -->
                <div id="myModal" class="modal row">
                    <!-- Modal content -->
                    <div class="modal-content col-md-6">
                        <div class="row">
                            <div class="col-md-12 align-right">
                                <span class="close" id="close-modal-status">&times;</span>
                            </div>
                        </div>
                        <h4>Simpan perubahan?</h4>
                        <div class="row">
                            <div class="col-md-6 align-right"></div>
                            <div class="col-md-3 align-right">
                                <button class="btn btn-danger" id="modal-no" style="width:75%;">Tidak</button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success" id="modal-yes" style="width:75%;">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal-barang" class="modal row">
                    <!-- Modal content -->
                    <div class="modal-content col-md-6">
                        <div class="row">
                            <div class="col-md-12 align-right">
                                <span class="close" id="close-modal-barang">&times;</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-barang">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page container area end -->

@endsection

@section('script')
<script type="text/javascript">
    var idPenj;
    var idBar;
    var dataPenjualan = <?php echo($penjualans) ?>;
    $(document).ready(function() {
        $('#close-modal-status')[0].onclick = function() {
            var data;
            $.each(dataPenjualan, function(key, value) {
                if(value.id == idPenj) {
                    data = value;
                    return false;
                }
            });
            $('#myModal').css('display', 'none');
            $('#modal-barang').css('display', 'block');
        }
        $('#close-modal-barang')[0].onclick = function() {
            $('#modal-barang').css('display', 'none');
        }
        $('#modal-yes').click(function() {
            $.get('/penjualan/set-status-barang-penjualan/'+idPenj+'/'+idBar+'/'+$('#status-'+idBar).val(), function(data) {
                console.log('success');
                $.each(dataPenjualan, function(key, value) {
                    if(value.id == idPenj) {
                        data = value;
                        return false;
                    }
                    $.each(data.barangs, function(key, val) {
                        if(val.id == idBar) {
                            val.status_id = $('#status-'+idBar).val();
                            return false;
                        }
                    });
                });
                $('#myModal').css('display', 'none');
                $('#modal-barang').css('display', 'block');
            });
        });
        $('#modal-no').click(function() {
            $('#myModal').css('display', 'none');
            $('#modal-barang').css('display', 'block');
        });
    });
    function lihatBarang(id) {
        $('#table-barang').html('');
        var data;
        idPenj = id;
        $.each(dataPenjualan, function(key, value) {
            if(id == value.id) {
                data = value;
                return false;
            }
        });
        console.log(data.barangs);
        $.each(data.barangs, function(key, value) {
            $('#table-barang').append(
                '<tr>'+
                    '<td>'+(key+1)+'</td>'+
                    '<td>'+value.nama+'</td>'+
                    '<td>'+value.qty+'</td>'+
                    '<td>'+value.harga+'</td>'+
                    '<td>'+value.harga_jual+'</td>'+
                    '<td>'+
                    '<select id="status-'+value.barang_id+'" onchange="changeStatus('+value.barang_id+')">'+
                        '@foreach($statuses as $status)'+
                        '<option value="{{$status->id}}">{{$status->nama}}</option>'+
                        '@endforeach'+
                    '</select>'+
                    '</td>'+
                '</tr>'
            );
            $('#status-'+value.barang_id).val(value.status_id);
        });
        $('#modal-barang').css('display', 'block');
    }
    
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal")) {
            var data;
            $('#myModal').css('display', 'none');
            $('#modal-barang').css('display', 'block');
        }
        if (event.target == document.getElementById("modal-barang")) {
            $('#modal-barang').css('display', 'none');
        }
    }
    function changeStatus(id) {
        console.log('hello '+id);
        idBar = id;
        $('#modal-barang').css('display', 'none');
        $('#myModal').attr({'style': 'display: block'});
    }
</script>
@endsection
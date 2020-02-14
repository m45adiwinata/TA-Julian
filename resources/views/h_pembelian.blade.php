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
                            <h4 class="header-title">Masukkan Rentang Tanggal</h4>
                            <div class="single-table">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" name="tanggal1" id="tanggal1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="date" name="tanggal2" id="tanggal2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-success" id="oke">Oke</button>
                                    </div>
                                </div>
                            </div>
                            <div class="single-report mb-xs-30" id="grafik">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-money"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Pembelian</h4>
                                        <p>Rentang Waktu</p>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h2 id="total-pembelians">Rp {{number_format($total, 2, ',', '.')}}</h2>
                                        <span>- 45.87</span>
                                    </div>
                                </div>
                                <canvas id="coin_salesx" height="100"></canvas>
                            </div>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Suplier</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Diskon</th>
                                                <th scope="col">Barang</th>
                                                <th scope="col">status</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="main-tbl-body">
                                            @foreach($pembelians as $key => $pembelian)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{date('d-m-Y', strtotime($pembelian->created_at))}}</td>
                                                <td>{{$pembelian->suplier()->first()->nama}}</td>
                                                <td>
                                                    Rp 
                                                    @php
                                                    $temp = 0;
                                                    foreach($pembelian->barangPembelian()->get() as $beli) {
                                                        $temp += $beli->harga_beli;
                                                    }
                                                    if($pembelian->type_diskon_id == 0) {
                                                        $temp -= $pembelian->diskon;
                                                    }
                                                    else {
                                                        $diskon = $temp * $pembelian->diskon / 100;
                                                        $temp -= $diskon;
                                                    }
                                                    echo number_format($temp, 2, ',', '.');
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                    if($pembelian->type_diskon_id == 0) {
                                                        if($pembelian->diskon) {
                                                            echo "Rp ".$pembelian->diskon;
                                                        }
                                                        else {
                                                            echo "Rp 0";
                                                        }
                                                    }
                                                    else {
                                                        echo $pembelian->diskon."%";
                                                    }
                                                    @endphp
                                                </td>
                                                <td>
                                                    <span id="lihat" class="status-p bg-primary" onclick="lihatBarang({{$pembelian->id}})">Lihat Barang</span>
                                                </td>
                                                <td>
                                                    <select name="status" id="status-{{$pembelian->id}}" onchange="setStatus({{$pembelian->id}})">
                                                        @foreach($statuses as $status)
                                                        <option value="{{$status->id}}"{{$pembelian->status_id == $status->id ? ' selected' : ''}}>{{$status->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <ul class="d-flex justify-content-center">
                                                        <li class="mr-3"><a href="{{route('pembelian.edit', $pembelian->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
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
<script>
    var idPemb;
    var dataPembelian = <?php echo($pembelians) ?>;
    var chart;
    var ctx;
    $(document).ready(function() {
        $('#oke').click(function() {
            var tgl1 = $('#tanggal1').val();
            var tgl2 = $('#tanggal2').val();
            $.get('/history-pembelian/get-data/'+tgl1+'/'+tgl2, function(data) {
                
                if ($('#coin_salesx').length) {
                    // var ctx = document.getElementById("coin_salesx").getContext('2d');
                    var lbls = [];
                    var dts = [];
                    $.each(data.pembelians, function(key, value) {
                        lbls.push(value.tanggal);
                        dts.push(value.temp);
                    });
                    console.log(lbls);
                    console.log(dts);
                    chart.data.labels = lbls;
                    chart.data.datasets[0].data = dts;
                    chart.update();
                }
                $('#main-tbl-body').html('');
                $.each(data.pembelians, function(key, value) {
                    $('#main-tbl-body').append(
                        '<tr>'+
                            '<th scope="row">'+(key+1)+'</th>'+
                            '<td>'+value.tanggal2+'</td>'+
                            '<td>'+value.suplier+'</td>'+
                            '<td>Rp '+value.temp+'</td>'+
                            '<td>'+value.diskon_js+'</td>'+
                            '<td>'+
                                '<span id="lihat" class="status-p bg-primary" onclick="lihatBarang('+value.id+')">Lihat Barang</span>'+
                            '</td>'+
                            '<td>'+
                                '<select name="status" id="status-'+value.id+'" onchange="setStatus('+value.id+')">'+
                                    '<option value="1">On Progress</option>'+
                                    '<option value="2">Complete</option>'+
                                    '<option value="3">Cancel</option>'+
                                '</select>'+
                            '</td>'+
                            '<td>'+
                                '<ul class="d-flex justify-content-center">'+
                                    '<li class="mr-3"><a href="/pembelian/'+value.id+'/edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>'+
                                '</ul>'+
                            '</td>'+
                        '</tr>'
                    );
                    $('#status-'+value.id).val(value.status_id);
                });
                console.log(data);
            });
        });
        if ($('#coin_salesx').length) {
            ctx = document.getElementById("coin_salesx").getContext('2d');
            chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        @foreach($pembelians as $pembelian)
                        '{{date("d/m/Y", strtotime($pembelian->created_at))}}',
                        @endforeach
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(117, 19, 246, 0.1)",
                        borderColor: '#0b76b6',
                        data: [
                        <?php 
                        foreach ($pembelians as $key => $pembelian) {
                            $temp = 0;
                            foreach($pembelian->barangPembelian()->get() as $beli) {
                                $temp += $beli->harga_beli;
                            }
                            if($pembelian->type_diskon_id == 0) {
                                $temp -= $pembelian->diskon;
                            }
                            else {
                                $diskon = $temp * $pembelian->diskon / 100;
                                $temp -= $diskon;
                            }
                            echo $temp.',';
                        }
                        ?>
                        ],
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold",
                                beginAtZero: !0,
                                maxTicksLimit: 5,
                                padding: 0
                            },
                            gridLines: {
                                drawTicks: !1,
                                display: !1
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 0,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "bold"
                            }
                        }]
                    }
                }
            });
        }
        $('#modal-yes').click(function() {
            var id = idPemb;
            $.get('/pembelian/set-status/' + id + '/' + $('#status-'+id).val(), function(data) {
                $('#myModal').css('display', 'none');
            });
        });
        $('#modal-no').click(function() {
            var data;
            $.each(dataPembelian, function(key, value) {
                if(value.id == idPemb) {
                    data = value;
                    return false;
                }
            });
            $('#status-'+idPemb).val(data.status_id);
            $('#myModal').css('display', 'none');
        });
    });
    function setStatus(id) {
        $('#myModal').attr({'style': 'display: block'});
        idPemb = id;
    }
    $('#close-modal-status')[0].onclick = function() {
        var data;
        $.each(dataPembelian, function(key, value) {
            if(value.id == idPemb) {
                data = value;
                return false;
            }
        });
        $('#status-'+idPemb).val(data.status_id);
        $('#myModal').css('display', 'none');
    }
    $('#close-modal-barang')[0].onclick = function() {
        $('#modal-barang').css('display', 'none');
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal")) {
            var data;
            $.each(dataPembelian, function(key, value) {
                if(value.id == idPemb) {
                    data = value;
                    return false;
                }
            });
            $('#status-'+idPemb).val(data.status_id);
            $('#myModal').css('display', 'none');
        }
        if (event.target == document.getElementById("modal-barang")) {
            $('#modal-barang').css('display', 'none');
        }
    }
    function lihatBarang(id) {
        $('#table-barang').html('');
        var data;
        $.each(dataPembelian, function(key, value) {
            if(id == value.id) {
                data = value;
                return false;
            }
        });
        console.log(data);
        $.each(data.barangs, function(key, value) {
            $('#table-barang').append(
                '<tr>'+
                    '<td>'+(key+1)+'</td>'+
                    '<td>'+value.nama+'</td>'+
                    '<td>'+value.qty+'</td>'+
                    '<td>'+value.harga+'</td>'+
                    '<td>'+value.harga_beli+'</td>'+
                '</tr>'
            );
        });
        $('#modal-barang').css('display', 'block');
    }
</script>
@endsection

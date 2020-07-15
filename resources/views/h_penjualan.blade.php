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
                                        <h4 class="header-title mb-0">Penjualan</h4>
                                        <p>Rentang Waktu</p>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h2 id="total-penjualans">Rp {{number_format($total, 2, ',', '.')}}</h2>
                                        <!-- <span>- 45.87</span> -->
                                    </div>
                                </div>
                                <canvas id="coin_salesx" height="100"></canvas>
                            </div>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Pelanggan</th>
                                                <th scope="col">Sales</th>
                                                <th scope="col">Barang</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="main-tbl-body">
                                            @foreach($penjualans as $key => $penjualan)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$penjualan->id}}</td>
                                                <td>{{date('d-m-Y', strtotime($penjualan->created_at))}}</td>
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
                                                    echo number_format($temp, 2, ',', '.');
                                                    @endphp
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
    var dataPenjualan = <?php echo(json_encode($penjualans)) ?>;
    var dataPenjualanGr = <?php echo(json_encode($penjualans2)) ?>;
    var chart;
    var ctx;
    $(document).ready(function() {
        $('#oke').click(function() {
            var tgl1 = $('#tanggal1').val();
            var tgl2 = $('#tanggal2').val();
            $.get('/history-penjualan/get-data/'+tgl1+'/'+tgl2, function(data) {
                if ($('#coin_salesx').length) {
                    var lbls = [];
                    var dts = [];
                    $.each(data.penjualans2, function(key, value) {
                        lbls.push(value.tanggal);
                        dts.push(value.temp);
                    });
                    chart.data.labels = lbls;
                    chart.data.datasets[0].data = dts;
                    chart.update();
                }
                $('#main-tbl-body').html('');
                $.each(data.penjualans, function(key, value) {
                    $('#main-tbl-body').append(
                        '<tr>'+
                            '<th scope="row">'+(key+1)+'</th>'+
                            '<td>'+value.id+'</td>'+
                            '<td>'+value.tanggal2+'</td>'+
                            '<td>'+value.nama_pelanggan+'</td>'+
                            '<td>'+value.nama_sales+'</td>'+
                            '<td>'+
                                '<span id="lihat" class="status-p bg-primary" onclick="lihatBarang('+value.id+')">Lihat Barang</span>'+
                            '</td>'+
                            '<td>Rp '+value.temp+'</td>'+
                            '<td>'+
                                '<ul class="d-flex justify-content-center">'+
                                    '<li class="mr-3"><a href="/penjualan/'+value.id+'/edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>'+
                                '</ul>'+
                            '</td>'+
                        '</tr>'
                    );
                });
                $('#total-penjualans').html('Rp ' + data.total);
            });
        });
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
                if (data == 1) {
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
                }
                else {
                    alert("Error: Stok barang tidak cukup.");
                    var data;
                    $.each(dataPenjualan, function(key, value) {
                        if(idPenj == value.id) {
                            data = value;
                            return false;
                        }
                    });
                    var temp;
                    $.each(data.barangs, function(key, value) {
                        if (value.barang_id == idBar) {
                            temp = value;
                            return false;
                        }
                    });
                    $('#status-'+idBar).val(temp.status_id);
                }
            });
        });
        $('#modal-no').click(function() {
            $('#myModal').css('display', 'none');
            $('#modal-barang').css('display', 'block');
        });
        if ($('#coin_salesx').length) {
            ctx = document.getElementById("coin_salesx").getContext('2d');
            chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        @foreach($penjualans2 as $p)
                        '{{date("d/m/Y", strtotime($p->created_at))}}',
                        @endforeach
                    ],
                    datasets: [{
                        label: "Sales",
                        backgroundColor: "rgba(117, 19, 246, 0.1)",
                        borderColor: '#0b76b6',
                        data: [
                        <?php 
                        foreach ($penjualans2 as $key => $p) {
                            $temp = 0;
                            foreach($p->barangPenjualan()->get() as $bp) {
                                if ($bp->status_id == 2) {
                                    $temp += $bp->harga_jual;
                                    if($p->type_diskon == 0) {
                                        $temp -= $p->diskon;
                                    }
                                    else {
                                        $diskon = $temp * $p->diskon / 100;
                                        $temp -= $diskon;
                                    }
                                }
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
    });
    function lihatBarang(id) {
        $('#table-barang').html('');
        // var data;
        idPenj = id;
        // $.each(dataPenjualan, function(key, value) {
        //     if(id == value.id) {
        //         data = value;
        //         return false;
        //     }
        // });
        $.get('modal-items-penjualan/' + id, function(data) {
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
        idBar = id;
        $('#modal-barang').css('display', 'none');
        $('#myModal').attr({'style': 'display: block'});
    }
</script>
@endsection

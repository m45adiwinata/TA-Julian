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
        @include('headerarea')
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
                                        <tbody>
                                            @foreach($penjualans as $key => $penjualan)
                                            <tr>
                                                <td>{{$per_page * ($penjualans->currentPage()-1) + $key + 1}}</td>
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
                                                        <li class="mr-3"><a href="/penjualan/get-nota/{{$penjualan->id}}" class="text-secondary"><i class="fa fa-print"></i></a></li>
                                                        <li class="mr-3"><a href="{{route('penjualan.edit', $penjualan->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <form action="penjualan" method="GET" id="limit" class="form-group" style="margin-right:10px;">
                                    <select name="per_page" class="custom-select">
                                        <option value="10"{{$per_page == 10 ? "selected" : ""}}>10</option>
                                        <option value="25"{{$per_page == 25 ? "selected" : ""}}>25</option>
                                        <option value="50"{{$per_page == 50 ? "selected" : ""}}>50</option>
                                        <option value="100"{{$per_page == 100 ? "selected" : ""}}>100</option>
                                    </select>
                                </form>
                                {{$penjualans->links()}}
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
    var dataPenjualan = <?php echo(json_encode($penjualans2)) ?>;
    $(document).ready(function() {
        $('select[name="per_page"]').change(function(e) {
            e.preventDefault();
            $('#limit').submit();
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
        idBar = id;
        $('#modal-barang').css('display', 'none');
        $('#myModal').attr({'style': 'display: block'});
    }
</script>
@endsection
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
                                        <tbody>
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
                            {{ $pembelians->links() }}
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
    $(document).ready(function() {
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
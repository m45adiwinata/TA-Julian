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
                            <h4 class="header-title">Masukkan Rentang Tanggal Penjualan</h4>
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
                        </div>
                    </div>
                </div>
                <!-- Progress Table end -->
            </div>
        </div>
    </div>
</div>
<!-- page container area end -->

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#oke').click(function() {
            var tanggal1 = $('#tanggal1').val();
            var tanggal2 = $('#tanggal2').val();
            $.get('/eoq/get-data-penjualan/'+tanggal1+'/'+tanggal2, function(data) {
                console.log(data);
            });
        });
    });
</script>
@endsection
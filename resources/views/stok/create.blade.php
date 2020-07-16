@extends('layout')
@section('content')
<form method="POST" action="{{route('stok-barang.store')}}">
	@csrf
	<select name="barang_id">
		@foreach($barangs as $barang)
		<option value="{{$barang->id}}">{{$barang->nama}}</option>
		@endforeach
	</select>
	<select name="lokasi_id">
		@foreach($lokasis as $lokasi)
		<option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>
		@endforeach
	</select>
	<select name="sub_lokasi_id">
		@foreach($sub_lokasis as $sub_lokasi)
		<option value="{{$sub_lokasi->id}}">{{$sub_lokasi->nama}}</option>
		@endforeach
	</select>
	<input type="number" name="jumlah" placeholder="jumlah..." value="1">
	<input type="submit" name="submit">
</form>

@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('select').select2();
	});
</script>
@endsection

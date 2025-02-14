<!DOCTYPE html>
<html>
<head>
	<title>Export Laporan Excel Pada Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<div class="table-responsive px-2">
		<center>
			<h4>Export Laporan Transaksi Barang Masuk</h4>
		</center>
		<table  class='table'>
			<td style="padding-left:90px;width:250px">
			<a href="/download/barang" class="btn btn-success my-3"  target="_blank">EXPORT EXCEL</a>
			</td>
			<td style="width:1100px"></td>
			<td style="padding-right:90px;width:250px">
			<a href="{{ url()->previous() }}" class="btn bg-warning my-3 " type="button">Kembali</a>
			</td>
		</table>
		
        
		
		<table class='table table-responsive table-sm table-bordered' style="padding-left:5%">
			<thead>
				<tr>
					<th>Kode Barang</th>
					<th>Suplier</th>
					<th>Barcode</th>
					<th>Nama Barang</th>
					<th>Satuan</th>
					<th>Jumlah</th>
					<th>Harga Beli</th>
					<th>Harga Jual</th>
					<th>Jenis Barang</th>
					<th>Kode Rak</th>
					<th>Jml Min</th>
					<th>Tgl Masuk</th>
				</tr>
			</thead>
			<tbody>
				@foreach($barang as $b)
				<tr>
					<td>{{$b->kode_barang}}</td>
					<td>{{$b->id_suplier}} - {{$b->nama_suplier}}</td>
					<td>{{$b->barcode}}</td>
					<td>{{$b->nama_barang}}</td>
					<td>{{$b->satuan}}</td>
					<td>{{$b->jml_brg}}</td>
					<td>@currency($b->harga_beli)</td>
					<td>@currency($b->harga_jual)</td>
					<td>{{$b->jenis_barang}}</td>
					<td>{{$b->kode_rak}}</td>
					<td>{{$b->qty_min}}</td>
					<td>{{$b->tgl_masuk}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
 
</body>
</html>
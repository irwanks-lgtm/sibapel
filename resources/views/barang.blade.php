<!DOCTYPE html>
<html>
<head>
	<title>Export Data Barang SIBAPEL</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="table-responsive py-3 px-2">
		<center>
			<h4>Export Data Barang SIBAPEL</h4>
		</center>
		<table  class='table'>
			<td style="padding-left:90px;width:250px">
			<a href="/download/barang" class="btn btn-success my-2"  target="_blank">EXPORT EXCEL</a>
			</td>
			<td style="width:1100px"></td>
			<td style="padding-right:90px;width:250px">
			<a href="{{ url()->previous() }}" class="btn bg-warning my-2 " type="button">Kembali</a>
			</td>
		</table>
		<table class='table table-responsive table-sm table-bordered' style="padding-left:5%;padding-right:5%;">
			<thead class="text-center">
				<tr>
					<th>Kode Barang</th>
					<th style="width:150px">Suplier</th>
					<th>Barcode</th>
					<th>Nama Barang</th>
					<th>Satuan</th>
					<th>Jml</th>
					<th style="width:110px">Harga Beli</th>
					<th style="width:110px">Harga Jual</th>
					<th style="width:80px">Jenis Barang</th>
					<th style="width:90px">Kode Rak</th>
					<th style="width:80px">Jml Min</th>
					<th style="width:100px">Tgl Masuk</th>
				</tr>
			</thead>
			<tbody>
				@foreach($barang as $b)
				<tr>
					<td>{{$b->kode_barang}}</td>
					<td>{{$b->id_suplier}} - {{$b->nama_suplier}}</td>
					<td>{{$b->barcode}}</td>
					<td>{{$b->nama_barang}}</td>
					<td class="text-center">{{$b->satuan}}</td>
					<td class="text-center">{{$b->jml_brg}}</td>
					<td class="text-right">@currency($b->harga_beli)</td>
					<td class="text-right">@currency($b->harga_jual)</td>
					<td>{{$b->jenis_barang}}</td>
					<td class="text-center">{{$b->kode_rak}}</td>
					<td class="text-center">{{$b->jml_min}}</td>
					<td>{{date_format(date_create($b->created_at), 'd-m-Y H:i:s')}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</body>
</html>

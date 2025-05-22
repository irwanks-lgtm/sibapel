<!DOCTYPE html>
<html>
<head>
	<title>Export Laporan Transaksi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container my-4">
		<center>
			<h4>Export Laporan Transaksi</h4>
		</center>

		<a href="/download/transaksi" class="btn btn-success my-3"  target="_blank">EXPORT EXCEL</a>
        <a href="{{ url()->previous() }}" class="btn bg-warning my-3" style="float:right;" type="button">Kembali</a>

		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>Kode Transaksi</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Jenis Transaksi</th>
					<th>Tgl Transaksi</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				@foreach($trx as $tx)
				<tr>
					<td>{{$tx->kode_transaksi}}</td>
					<td>{{$tx->kode_barang}}</td>
					<td>{{$tx->nama_barang}}</td>
					<td>{{$tx->jml}}</td>
					<td>@currency($tx->harga)</td>
					<td>{{$tx->jenis_transaksi}}</td>
					<td>{{$tx->created_at}}</td>
					<td>{{$tx->keterangan}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Export Laporan Penjualan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container my-4">
		<center>
			<h4>Export Laporan Penjualan</h4>
		</center>

		<a href="/download/laporan-penjualan" class="btn btn-success my-3"  target="_blank">EXPORT EXCEL</a>
        <a href="{{ url()->previous() }}" class="btn bg-warning my-3" style="float:right;" type="button">Kembali</a>

		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Tgl Transaksi</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $dt)
				<tr>
					<td>{{$dt->kode_barang}}</td>
					<td>{{$dt->nama_barang}}</td>
					<td>{{$dt->total_brg}}</td>
					<td>@currency($dt->total_harga)</td>
					<td>{{$dt->created_at}}</td>
					<td>{{$dt->keterangan}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</body>
</html>

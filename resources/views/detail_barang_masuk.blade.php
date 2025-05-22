@extends('layouts.user_type.auth')

@section('content')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<div class="animate__animated animate__bounceInLeft animate__delay-1s">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ strtoupper(str_replace([':', '-', '/'], ' ', Request::path())) }}</h5>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2 my-5">
                    <div class="table-responsive p-0 mx-7">
                    <table class="table table-sm">
                        <tr>
                          <td><label>Kode Barang</label></td>
                          <td><?php echo $tr[0]->kode_barang ?></td>
                        </tr>
                        <tr>
                          <td><label>Nama Barang</label></td>
                          <td><?php echo $tr[0]->nama_barang ?></td>
                        </tr>
                        <tr >
                          <td><label>Jumlah</label></td>
                          <td><?php echo $tr[0]->jml ?></td>
                        </tr>
                        <tr >
                          <td><label>Harga</label></td>
                          <td>@currency($tr[0]->harga)</td>
                        </tr>
                        <tr>
                          <td><label>Keterangan</label></td>
                          <td><?php if(!empty($tr[0]->keterangan)){echo $tr[0]->keterangan;}else{echo '-';} ?></td>
                        </tr>
                        <tr>
                          <td><label>Tgl Transaksi</label></td>
                          <td><?php echo date_format(date_create($tr[0]->created_at), "d M Y H:i:s") ?></td>
                        </tr>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

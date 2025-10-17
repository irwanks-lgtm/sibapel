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
                        <?php foreach($barang as $brg) { ?>
                        <tr>
                          <td style="width:20%" ><label>Kode Barang</label></td>
                          <td ><?php echo $brg->kode_barang ?></td>
                        </tr>
                        <tr>
                          <td><label>Barcode</label></td>
                          <td><?php echo $brg->barcode ?></td>
                        </tr>
                        <tr>
                          <td><label>Nama Barang</label></td>
                          <td><?php echo $brg->nama_barang ?></td>
                        </tr>
                        <tr>
                          <td><label>Deskripsi</label></td>
                          <td><p class="text-wrap text-break"><?php echo $brg->deskripsi?></p></td>
                        </tr>
                        <tr >
                          <td><label>Jumlah</label></td>
                          <td><?php echo $brg->jml_brg . " " . $brg->satuan ?>
                        <?php if($brg->jml_brg<=$brg->jml_min){ ?>
                            <i class="fa-solid fa-triangle-exclamation text-xs text-danger" style="padding-left:20px;"></i>
                            <span class="text-xs text-danger"><em>Jumlah Barang Hampir Habis</em></span>
                        <?php } ?>
                          </td>
                        </tr>
                        <tr >
                          <td><label>Rak Simpan</label></td>
                          <td>{{ $brg->kode_rak }}</td>
                        </tr>
                        <tr >
                          <td><label>Harga Beli</label></td>
                          <td>@currency($brg->harga_beli)</td>
                        </tr>
                        <tr >
                          <td><label>Harga Jual</label></td>
                          <td>@currency($brg->harga_jual)</td>
                        </tr>
                        <tr>
                          <td><label>Jumlah Minimum</label></td>
                          <td><?php echo $brg->jml_min ?></td>
                        </tr>
                        <tr>
                          <td><label>Jenis Barang</label></td>
                          <td><?php echo $brg->jenis_barang ?></td>
                        </tr>
                        <tr>
                          <td><label>Waktu Tunggu</label></td>
                          <td><?php echo $brg->waktu_tg ?> Hari</td>
                        </tr>

                        <?php } ?>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

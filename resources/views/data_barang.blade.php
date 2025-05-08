@extends('layouts.user_type.auth')

@section('content')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg animate__animated animate__bounceInLeft animate__delay-1s">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Tabel Data Barang</h5>
                </div>
                <table>
                <td>
                  <a href="{{url('cetak-barang')}}" class="btn bg-gradient-success btn-sm mb-0 mx-2" type="button">Download</a>
                  <?php if(Str::contains(Session::get('idUser'), 'ADM')){ ?>
                      <a href="tambah-data-barang" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Data</a>
                  <?php } ?>
                </td>
                </table>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center table-hover mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Satuan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Beli</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Jual</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jml Min</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Masuk</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <?php foreach($barang as $brg) { ?>
                    <tbody class="text-center">
                    <tr>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $brg->kode_barang; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $brg->nama_barang; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 <?php if($brg->jml_brg<=$brg->jml_min){ echo 'text-danger'; } ?>"><?php echo $brg->jml_brg; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $brg->satuan; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">@currency($brg->harga_beli)</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">@currency($brg->harga_jual)</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $brg->jml_min; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php $date = date_create($brg->tgl_masuk); echo DATE_FORMAT($date, "d M Y"); ?></p>
                      </td>
                      <td class="align-middle">
                        <a href="detail-barang/{{$brg->kode_barang}}" class="btn bg-gradient-success btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Detail">
                          <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <a href="edit-barang/{{$brg->kode_barang}}" class="btn bg-gradient-info btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="hapus/{{ $brg->kode_barang }}" class="btn bg-gradient-danger btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Hapus">
                          <i class="fa-regular fa-trash-can"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  
  @endsection

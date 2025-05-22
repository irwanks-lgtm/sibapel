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
                      <h5 class="mb-0">Tabel Barang Keluar</h5>
                  </div>
                  <?php if(Str::contains(Session::get('idUser'), 'ADM')){ ?>
                    <a href="retur-barang" class="btn bg-gradient-dark btn-sm mb-0" type="button">Retur Barang</a>
                  <?php } ?>
              </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Transaksi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Transaksi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis transaksi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <?php foreach ($trx as $tx) {?>
                  <tbody>
                      <td>
                        <p class="text-center text-xs font-weight-bold mb-0"><?php echo $tx->kode_transaksi ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $tx->nama_barang ?></p>
                      </td>
                      <td>
                        <p class="text-center text-xs font-weight-bold mb-0"><?php echo $tx->jml ?></p>
                      </td>
                      <td>
                        <p class="text-center text-xs font-weight-bold mb-0">@currency($tx->harga)</p>
                      </td>
                      <td>
                        <p class="text-center text-xs font-weight-bold mb-0"><?php  echo date_format(date_create($tx->created_at), "j M Y") ?></p>
                      </td>
                      <td>
                        <p class="text-center text-xs font-weight-bold mb-0"><?php echo $tx->jenis_transaksi ?></p>
                      </td>
                      <td class="align-middle">
                        <a href="#" class="btn bg-gradient-success btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Detail">
                          <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <a href="#" class="btn bg-gradient-danger btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Hapus">
                          <i class="fa-regular fa-trash-can"></i>
                        </a>
                      </td>
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

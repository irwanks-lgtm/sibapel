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
                  <h5 class="mb-0">Tabel Barang Masuk</h5>
              </div>
              <table>
                <td>
                <a href="{{url('cetak-transaksi')}}" class="btn bg-gradient-success btn-sm mb-0 mx-2" type="button">Download</a>
                <?php if(Str::contains(Session::get('idUser'), 'ADM')){ ?>
                  <a href="{{url('/tambah-barang-masuk')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah  Data</a>
                <?php } ?>
                </td>
              </table>
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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <?php foreach ($trx as $tx) {?>
                  <tbody class="text-center">
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $tx->kode_transaksi ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $tx->kode_barang ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $tx->jml ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">@currency($tx->harga)</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php  echo date_format(date_create($tx->tgl_transaksi), "j M Y") ?></p>
                      </td>
                      <td class="align-middle">
                        <a href="#" class="btn bg-gradient-info btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                          <i class="fa-regular fa-pen-to-square"></i>
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

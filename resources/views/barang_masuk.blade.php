@extends('layouts.user_type.auth')

@section('content')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg animate__animated animate__bounceInLeft animate__delay-1s">
  <script src="https://kit.fontawesome.com/af4366748c.js" crossorigin="anonymous"></script>
  
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Tabel Barang Masuk</h5>
                </div>
                <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Data</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center table-hover mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id Transaksi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Barcode</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Satuan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Beli</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Jual</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Suplier</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jml Min</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <tr>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">BM001140324</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">B4012</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">10241285748</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Mesin Cuci Ma..</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">pcs</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Rp. 800.000</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Rp. 1.300.000</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">MASPION</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">10</p>
                      </td>
                      <td class="align-middle">
                        <a href="#" class="btn bg-gradient-success btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Detail">
                          <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <a href="#" class="btn bg-gradient-info btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="btn bg-gradient-danger btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Hapus">
                          <i class="fa-regular fa-trash-can"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  
  @endsection

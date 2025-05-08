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
                    <h5 class="mb-0">Stok Opname</h5>
                </div>
                <a href="/buat-opname" class="btn bg-gradient-primary btn-sm mb-0" type="button">Buat Stok Opname</a>
              </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kode opname</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kode rak</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">waktu</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PIC</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($stok as $st) { ?>
                      <tr>
                        <td>
                          <a  href="data-opname/{{$st->kode_stok}}"  style="display: block; height: 100%;" class="text-xs font-weight-bold mb-0">{{$st->kode_stok}}</a>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$st->kode_rak}}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$st->waktu_stok}}</p>
                        </td>
                        <td>
                          <p class="text-xs text-capitalize font-weight-bold mb-0">{{$st->nama_pengguna}}</p>
                        </td>
                        <td>
                          <p class="text-xs <?php if($st->status == 'SELESAI'){ echo 'text-success'; }else{ echo 'text-warning'; } ?> font-weight-bold mb-0">{{$st->status}}</p>
                        </td>
                     </tr>
                     <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  @endsection

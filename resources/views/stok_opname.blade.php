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
                <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-backdrop="false" data-bs-toggle="modal" data-bs-target="#exampleModal">+&nbsp; Tambah Data</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kode opname</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">gudang rak</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PIC</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($stok as $st) { ?>
                      <tr>
                        <td>
                          <a  href="detail-opname/{{$st->kode_stok}}"  style="display: block; height: 100%;" class="text-xs font-weight-bold mb-0">{{$st->kode_stok}}</a>
                        </td>
                        <td>
                         <p class="text-xs font-weight-bold mb-0">{{$st->kode_rak}}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$st->id_pengguna}}</p>
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
  <!-- Modal -->
  <div class="modal fade" id="exampleModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Opname</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
             </div>
              <div class="modal-body">
                <form method="POST" action="tambah-opname">
                  @csrf
                <table class="table table-responsive table-sm">
                  <tr>
                    <td class="label py-2">
                      <label>Pilih Rak</label>
                    </td>
                    <td>
                      <select name="rak" id="rak" class="form-select">
                        <option selected>Pilih Rak...</option>
                        <?php foreach($rak as $r) {?>
                        <option value="{{$r->kode_rak}}">{{$r->nama_rak}}</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="label py-2">
                      <label>PIC</label>
                    </td>
                    <td>
                      <select name="pic" id="pic" class="form-select">
                        <option selected>Pilih PIC...</option>
                        <?php foreach($user as $u) {?>
                        <option value="{{$u->id_pengguna}}">{{Str::title($u->role)}} - {{Str::title($u->nama_pengguna)}}</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-gradient-danger btn-sm mb-0" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn bg-gradient-success btn-sm mb-0">Lanjut</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  @endsection

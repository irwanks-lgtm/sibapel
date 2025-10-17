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
                    <h5 class="mb-0">Tambah Validasi Stok</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
              </div>

              <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
              <form method="POST" action="{{ url('/tambah-opname') }}" autocomplete="off">
                @csrf
                <table>
                  <tr>
                    <td style="width:150px"><label>Kode Rak</label></td>
                    <td>
                      <select class="form-select my-2" name="rak" id="rak" style="width:90px">
                        <?php foreach ($rak as $r) { ?>
                        <option value="{{$r->kode_rak}}">{{$r->kode_rak}}</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label>Penanggung Jawab</label></td>
                    <td>
                      <select class="form-select my-2" name="pic" id="pic" style="width:170px">
                        <?php foreach($pic as $u){ ?>
                        <option value="{{$u->id_pengguna}}">{{$u->nama_pengguna}}</option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="my-4" colspan="2">
                      <button type="submit" class="btn bg-gradient-success mt-4 mb-0">Buat Stok Opname</button>
                    </td>
                  </tr>
                </table>
              </form>
             </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  @endsection

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
                    <h5 class="mb-0">Tambah Gudang Penyimpanan</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('/simpan-gudang')}}" autocomplete="off">    
                  @csrf              
                    <div class="mb-2">
                      <table>
                        <tr>
                          <td><label>Kode Gudang</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Kode Gudang" name="kdgd">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Nama Gudang</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Nama Gudang" name="nmgd">
                          </td>
                        </tr>
                      </table>
                    </div>
                    <button type="submit" class="btn bg-gradient-success w-10 mt-4 mb-0">Simpan</button>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  @endsection

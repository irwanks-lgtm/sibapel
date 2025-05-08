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
                    <h5 class="mb-0">Tambah Suplier</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('/tambahsuplier')}}" autocomplete="off">
                  @csrf
                    <div class="mb-2">
                      <table>
                        <tr>
                          <td><label>ID Suplier</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="ID Suplier" name="idsup">
                          @error('idsup')
                            <div class="text-xs text-danger">{{$message}}</div>
                          @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Nama Suplier</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Nama Suplier" name="namasup">
                          @error('namasup')
                            <div class="text-xs text-danger">{{$message}}</div>
                          @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Alamat</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Alamat Suplier" name="alamat">
                          @error('alamat')
                            <div class="text-xs text-danger">{{$message}}</div>
                          @enderror
                          </td>
                        </tr>
                        <tr >
                          <td><label>No. HP</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <input type="text" class="form-control my-2" placeholder="No. HP" name="nohp">
                            @error('nohp')
                            <div class="text-xs text-danger">{{$message}}</div>
                            @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Pembayaran</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <select name="pembayaran" id="pembayaran" class="form-select my-2" style="width:250px">
                              <option selected>Pilih Jenis Pembayaran...</option>
                              <option value="Transfer">Transfer</option>
                              <option value="Tunai">Tunai</option>
                            </select>
                            @error('pembayaran')
                            <div class="text-xs text-danger">{{$message}}</div>
                            @enderror
                          </td>
                        </tr>
                        <tr >
                          <td><label>Keterangan</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" name="keterangan" id="keterangan" placeholder="Keterangan">
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
  <script>
    $('#pembayaran').change(function(){
    var pembayaran = $(this).val();
    if(pembayaran=='Transfer'){
        $('#keterangan').prop('readonly', false);
        $('#keterangan').prop('required', true);
        $('#keterangan').focus();
    }else{
        $('#keterangan').prop('readonly', true);
        $('#keterangan').prop('required', false);
    }
  });
</script>
  @endsection

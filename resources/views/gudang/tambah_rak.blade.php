@extends('layouts.user_type.auth')

@section('content')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg animate__animated animate__bounceInLeft animate__delay-1s">
  <script src="https://kit.fontawesome.com/af4366748c.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Tambah Rak Penyimpanan</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('/simpan-rak')}}" autocomplete="off">    
                  @csrf              
                    <div class="mb-2">
                      <table>
                        <tr>
                          <td><label>Nama Gudang</label></td>
                          <td style="padding-left: 20px;">
                            <select name="nmgd" id="nmgd" class="form-select my-2" >
                              <option selected>Pilih Nama Gudang...</option>
                              <?php foreach ($gudang as $g) {?>
                              <option value="<?php echo $g->nama_gudang ?>"><?php echo $g->nama_gudang ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Kode Gudang</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Kode Gudang" name="kdgd" id="kdgd" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Kode Rak</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Kode Rak" name="kdrk"  id="kdrk">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Nama Rak</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Nama Rak" name="nmrk"  id="nmrk">
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
    $('#nmgd').change(function(){
    var id = $(this).val();
    var url = '{{ route("getDetailGudang", ":nmgd") }}';
    url = url.replace(':nmgd', id);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: {
                _token: '{!! csrf_token() !!}',
              },
        success: function(response){
            if(response != null){
                $('#kdgd').val(response.kode_gudang);
                $("#kdrk").first().focus();
                $('#kdrk').val('');
                $('#nmrk').val('');
            }
        }
      });
    });
  </script>
  @endsection

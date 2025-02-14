@extends('layouts.user_type.auth')

@section('content')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg animate__animated animate__bounceInLeft animate__delay-1s">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/af4366748c.js" crossorigin="anonymous"></script>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">RETUR BARANG</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('retur')}}" autocomplete="off">
                    @csrf        
                    <div class="mb-2">
                      <table>
                        <tr>
                          <td><label>Nama Barang</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <select name="nmbrg" id="nmbrg" class="form-select my-2" >
                              <option selected>Pilih Nama Barang...</option>
                              <?php foreach ($barang as $brg) {?>
                              <option value="<?php echo $brg->nama_barang ?>"><?php echo $brg->nama_barang ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Kode Barang</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Kode Barang" name="kodebrg" id="kodebrg" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Suplier</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Suplier" name="suplier" id="suplier" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Jumlah Barang</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Jumlah Barang" name="jml" id="jml" readonly>
                          </td>
                        </tr>
                        <tr >
                          <td><label>Jumlah Retur</label></td>
                          <td style="padding-left: 20px;">
                            <input type="text" class="form-control my-2" placeholder="Jumlah Retur Barang" name="retur" id="retur">
                          </td>
                        </tr>
                        <tr >
                          <td><label>Keterangan</label></td>
                          <td style="padding-left: 20px;">
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

   
<script type="text/javascript">
  
  $('#nmbrg').change(function(){
    var id = $(this).val();
    var url = '{{ route("getDetails", ":nmbrg") }}';
    url = url.replace(':nmbrg', id);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: {
                _token: '{!! csrf_token() !!}',
              },
        success: function(response){
            if(response != null){
                $('#kodebrg').val(response.kode_barang);
                $('#suplier').val(response.nama_suplier);
                $('#jml').val(response.jml_brg);
                $("#retur").first().focus();
                $("#retur").val('');
                $("#keterangan").val('');
            }
        }
    });
});
</script>


  @endsection

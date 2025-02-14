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
                    <h5 class="mb-0">Penjualan</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('penjualan') }}" id="posForm" autocomplete="off">
                    @csrf        
                    <div class="mb-2">
                      <table>
                        <tr>
                          <td><label>Nama Barang</label></td>
                          <td colspan="4" style="padding-left: 20px;">
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
                          <td colspan="4" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Kode Barang" name="kodebrg" id="kodebrg" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Jumlah Barang</label></td>
                          <td colspan="4" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Jumlah Barang" name="jml" id="jml"  >
                          </td>
                        </tr>
                        <tr>
                          <td><label>Total Harga</label></td>
                          <td  style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Total Harga" name="total" id="total" readonly>
                          </td>
                          <td style="padding-left: 20px;"><label>Diskon</label></td>
                          <td style="padding-left: 10px;">
                          <input type="text" class="form-control my-2" style="width:150px" placeholder="Diskon" name="disc" id="disc">
                          </td>
                        </tr>
                        <tr class="hargaDiskon">
                        </tr>
                        <tr>
                          <td><label>Keterangan</label></td>
                          <td colspan="4" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Keterangan" name="keterangan" id="keterangan">
                          </td>
                        </tr>
                      </table>
                    </div>
                    <button type="submit" class="btn bg-gradient-success w-10 mt-4 mb-0">Bayar</button>
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
                $("#jml").first().focus();
                $('#total').val('');
                $('#brgMasuk').val('');
            }
        }
      });
  });

  $('#jml').change(function(){
    var nama = $('#nmbrg').val();
    var url = '{{ route("getDetails", ":nmbrg") }}';
    url = url.replace(':nmbrg', nama);
    
    var id = $(this).val();
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: {
                _token: '{!! csrf_token() !!}',
              },
        success: function(response){
            if(response != null){
                $('#total').val('Rp. ' + Intl.NumberFormat('en-DE').format(response.harga_jual * id));
            }
        }
      });
  });

  $('#disc').change(function(){
    var disc = $(this).val();
    var total = $('#total').val().match(/\d/g);
    total = total.join("");
    var discount = $(this).val().match(/\d/g);
    if(discount !== null){
      discount = discount.join("");
      var FIELDS_TEMPLATE = $('#fields-templates').text();
      var $form = $('#posForm');
      var $fields = $form.find('.hargaDiskon');
      
      $fields.append("<td><label>Harga Diskon</label></td><td colspan=\"4\" style=\"padding-left: 20px;\"><input type=\"text\" class=\"form-control my-2\" placeholder=\"Harga Setelah Diskon\" name=\"harDisc\" id=\"harDisc\"></td><td style=\"padding-left: 20px;\"><button type=\"button\" class=\"btn btn-sm btn-danger my-2\" onclick=\"hapusDiskon(this)\">Remove</button>");
      var diskon = total - discount
      $('#harDisc').val('Rp. ' + Intl.NumberFormat('en-DE').format(diskon));
    }else{
        
    }
  });
</script>

<script>
var disc = document.getElementById('disc');
disc.addEventListener('keyup', function(e)
{
    disc.value = formatRupiah(this.value, 'Rp. ');
});

function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split    = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah     = split[0].substr(0, sisa),
        ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
</script>

<script>
  function hapusDiskon(btndel) {
    if (typeof(btndel) == "object") {
        $(btndel).closest("tr").remove();
        $('#disc').val('');
    } else {
        return false;
    }
}
</script>
  @endsection

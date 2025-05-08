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
                    <h5 class="mb-0">Edit Data Barang</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('/editbarang') }}" autocomplete="off">    
                  @csrf              
                    <div class="mb-2">
                      <table>
                        <?php foreach($barang as $brg) { ?>
                        <tr>
                          <td><label>Suplier</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <select name="suplier" id="inputSuplier" class="form-select my-2" style="width:70%;">
                              <option selected>Pilih Suplier...</option>
                              <?php foreach($suplier as $sup) { ?>
                              <option <?php if($brg->id_suplier==$sup->id_suplier){ echo "selected='selected'"; } ?> value="<?php echo $sup->id_suplier; ?>"><?php echo $sup->nama_suplier; ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Kode Barang</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Kode Barang" name="kdbrg" id="kdbrg" value="<?php echo $brg->kode_barang ?>" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Barcode</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Barcode" name="barcode" id="barcode" value="<?php echo $brg->barcode ?>">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Nama Barang</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Nama Barang" name="nmbrg" id="nmbrg" value="<?php echo $brg->nama_barang ?>">
                          </td>
                        </tr>
                        <tr >
                          <td><label>Jumlah</label></td>
                          <td style="padding-left: 20px;">
                            <input type="text" class="form-control mt-2" placeholder="Jumlah" name="jml" id="jml" value="<?php echo $brg->jml_brg ?>">
                          </td>
                          <td><label class="mx-2">Satuan</label></td>
                          <td class="form-inline" style="padding-left: 10px;">
                            <input type="text" class="form-control" placeholder="Satuan" name="satuan" id="satuan" value="<?php echo $brg->satuan ?>">
                          </td>
                        </tr>
                        <?php if($brg->jml_brg<=$brg->jml_min){ ?>
                        <tr>
                          <td></td>
                          <td  style="padding-left: 25px;" >
                            <i class="fa-solid fa-triangle-exclamation text-xs text-danger mb-2"></i>
                            <span class="text-xs text-danger"><em>Jumlah Barang Hampir Habis</em></span>
                          </td>
                        </tr>
                        <?php } ?>
                        <tr >
                          <td><label>Harga Beli</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" name="harga_beli" id="beli" placeholder="Harga Beli" value="<?php echo $brg->harga_beli ?>" data-type="currency">
                          </td>
                          <td><label class="mx-2">Harga Jual</label></td>
                          <td style="padding-left: 10px;">
                          <input type="text" class="form-control" name="harga_jual" id="jual" placeholder="Harga Jual" value="<?php echo $brg->harga_jual ?>">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Jumlah Minimum</label></td>
                          <td colspan="3" style="padding-left: 20px;" >
                            <input type="text" class="form-control my-2" name="jml_min" id="jmlmin" placeholder="Jumlah Minimum" value="<?php echo $brg->jml_min ?>" style="width:30%;">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Jenis Barang</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <select name="jenis" id="inputJenis" class="form-select my-2" style="width:50%;">
                              <option selected>Pilih Jenis Barang...</option>
                              <option <?php if($brg->jenis_barang=="Elektronik"){ echo "selected='selected'"; } ?> value="Elektronik">Elektronik</option>
                              <option <?php if($brg->jenis_barang=="Tableware"){ echo "selected='selected'"; } ?> value="Tableware">Tableware</option>
                              <option <?php if($brg->jenis_barang=="Perlengkapan Dapur"){ echo "selected='selected'"; } ?> value="Perlengkapan Dapur">Perlengkapan Dapur</option>
                              <option <?php if($brg->jenis_barang=="Pot Bunga"){ echo "selected='selected'"; } ?> value="Pot Bunga">Pot Bunga</option>
                              <option <?php if($brg->jenis_barang=="Furnitur"){ echo "selected='selected'"; } ?> value="Furnitur">Furnitur</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><label>Rak Simpan</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <input type="text" class="form-control my-2" name="rak" id="rak" placeholder="Jumlah Minimum" value="<?php echo $brg->kode_rak ?>" style="width:30%;">
                          </td>
                        </tr>
                        <?php } ?>
                      </table>
                    </div>
                    <button type="submit" class="btn bg-gradient-success w-10 mt-4 mb-0">Simpan</button>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
<script>
var harga_beli = document.getElementById('beli');
var harga_jual = document.getElementById('jual');

harga_beli.addEventListener('keyup', function(e)
{
    harga_beli.value = formatRupiah(this.value, 'Rp. ');
});
harga_jual.addEventListener('keyup', function(e)
{
    harga_jual.value = formatRupiah(this.value, 'Rp. ');
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

</main>
@endsection

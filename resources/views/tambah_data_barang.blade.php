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
                    <h5 class="mb-0">Tambah Data Barang</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('/tambah') }}" autocomplete="off">    
                  @csrf              
                    <div class="mb-2">
                      <table>
                        <tr>
                          <td><label>Suplier</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <select name="suplier" id="inputSuplier" class="form-select my-2" style="width:70%;">
                              <option selected>Pilih Suplier...</option>
                              <?php foreach($suplier as $sup) { ?>
                              <option value="<?php echo $sup->id_suplier; ?>"><?php echo $sup->nama_suplier; ?></option>
                              <?php } ?>
                            </select>
                              @error('suplier')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Kode Barang</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Kode Barang" name="kdbrg" id="kdbrg">
                              @error('kdbrg')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Barcode</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Barcode" name="barcode" id="barcode">
                          @error('barcode')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Nama Barang</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Nama Barang" name="nmbrg" id="nmbrg">
                          @error('nmbrg')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                        </tr>
                        <tr >
                          <td><label>Jumlah</label></td>
                          <td style="padding-left: 20px;">
                            <input type="text" class="form-control my-2" placeholder="Jumlah" name="jml" id="jml">
                            @error('jml')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                          <td><label class="mx-2">Satuan</label></td>
                          <td class="form-inline" style="padding-left: 10px;">
                            <input type="text" class="form-control" placeholder="Satuan" name="satuan" id="satuan">
                            @error('satuan')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                        </tr>
                        <tr >
                          <td><label>Harga Beli</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control" name="harga_beli" id="beli" placeholder="Harga Beli">
                          @error('harga_beli')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                          <td><label class="mx-2">Harga Jual</label></td>
                          <td style="padding-left: 10px;">
                          <input type="text" class="form-control" name="harga_jual" id="jual" placeholder="Harga Jual">
                          @error('harga_jual')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Jenis Barang</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <select name="jenis" id="inputJenis" class="form-select my-2" style="width:50%;">
                              <option selected>Pilih Jenis Barang...</option>
                              <option value="Elektronik">Elektronik</option>
                              <option value="Tableware">Tableware</option>
                              <option value="Perlengkapan Dapur">Perlengkapan Dapur</option>
                              <option value="Pot Bunga">Pot Bunga</option>
                              <option value="Furnitur">Furnitur</option>
                            </select>
                            @error('jenis')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                        </tr>
                        <tr>
                          <td><label>Rak Simpan</label></td>
                          <td style="padding-left: 20px;">
                            <input type="text" class="form-control my-2" name="rak" id="rak" placeholder="Kode Rak">
                            @error('rak')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                          <td style="padding-left: 15px;"><em class="text-xs">contoh : A.1.2 </em></td>
                        </tr>
                        <tr>
                          <td><label>Waktu Tunggu</label></td>
                          <td style="padding-left: 20px;width:140px;">
                            <input type="text" class="form-control my-2" name="waktu_tg" id="waktu_tg" placeholder="Waktu Tunggu">
                            @error('waktu_tg')
                                <div class="text-xs text-danger">{{$message}}</div>
                              @enderror
                          </td>
                          <td style="padding-left: 15px;"><em class="text-xs">Hari </em></td>
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

@extends('layouts.user_type.auth')

@section('content')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<div class="animate__animated animate__bounceInLeft animate__delay-1s">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Tabel Data Stok Opname</h5>
                        </div>
                        
                        <table>
                            <td>
                            <a href="download/form/opname?{{$idStok}}" class="btn bg-gradient-success btn-sm my-2" type="button">CETAK FORM</a>
                            </td>
                        </table>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" data-id="tabelStok">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kode Barang
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Barang
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Waktu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aktual
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Selisih
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            <form method="POST" action="simpan-opname">
                                @csrf
                            <?php foreach($brg as $brg) { ?>
                            <tr>
                                <input type="hidden" name="kdstok" id="kdstok" value="{{$idStok}}">
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="background:transparent; border: 1px;" name="kdbrg[]" id="kdbrg" value="{{$brg->kode_barang}}" readonly></center>
                                </td>
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="background:transparent; border: 1px;" name="nmbrg[]" id="nmbrg" value="{{$brg->nama_barang}}" readonly></center>
                                </td>
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="background:transparent; border: 1px;" name="waktu[]" id="waktu" value="{{date_format(date_create(now()), 'd M Y H:i:s')}}" readonly></center>
                                </td>
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="width:60px;background:transparent; border: 1px;" name="jml[]" id="jml" value="{{$brg->jml_brg}}" readonly></center>
                                </td>
                                <td class="align-items-center">
                                    <center><input type="text" class="form-control text-center my-2" style="width:60px; border: 1px;" name="aktual[]" id="aktual" readonly></center>
                                </td>
                                <td class="align-items-center">
                                    <center><input type="text" class="form-control text-center my-2"  style="width:60px;background: transparent; border: none;" name="selisih[]" id="selisih" readonly></center>
                                </td>
                                <td class="align-middle">
                                    <a type="button" name="btn-edit" id="btn-edit" data-bs-toggle="tooltip" data-bs-original-title="Edit" value="enable">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            <input class="btn bg-gradient-warning btn-sm mx-2 my-2" type="submit" value="SIMPAN">
                            </form>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script>
$("table[data-id='tabelStok'] tbody").on('click', '#btn-edit', function() {
    $(this).closest('tr').find('#aktual').prop('readonly', false);
    $(this).closest('tr').find('#aktual').val('');
    $(this).closest('tr').find('#aktual').focus();
    $(this).closest('tr').find('#aktual').on('change', function() {
        $(this).closest('tr').find('#aktual').prop('readonly', true);
        $(this).closest('tr').find('#selisih').val($(this).closest('tr').find('#aktual').val() - $(this).closest('tr').find('#jml').val());
    });
});
</script>

 
@endsection
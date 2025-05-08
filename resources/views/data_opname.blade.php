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
                            <a href="/download/opname/{{$kodeStok}}" class="btn bg-gradient-success btn-sm my-2 mx-2" type="button">CETAK</a>
                            <a href="{{ url('stok-opname') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
                            </td>
                        </table>
                    </div>
                </div>
                <div class="card-body px-4 pb-4" style="width:30%">
                    <table class="table table-sm mb-0 ml-3 font-weight-bolder">
                        <tr>
                            <td class="text-sm">Kode Opname</td>
                            <td>: {{$kodeStok}}</td>
                        </tr>
                        <tr>
                            <td class="text-sm ">PIC</td>
                            <td class="text-capitalize">: {{$dataOpname[0]->nama_pengguna}}</td>
                        </tr>
                        <tr>
                            <td class="text-sm">Status</td>
                            <td class="
                            <?php
                            if($dataOpname[0]->status=='PROSES'){
                                echo 'text-warning';
                            }else{
                                echo 'text-success';
                            }
                            ?>
                            text-capitalize">: {{$dataOpname[0]->status}}</td>
                        </tr>
                    </table>
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
                                    <?php
                                    if($dataOpname[0]->status=='PROSES'){
                                    echo    '<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>';
                                    }
                                    ?>

                                </tr>
                            </thead>
                        <form method="POST" action="{{ url('/simpan-opname') }}">
                            @csrf
                            <tbody class="text-center">
                            <?php foreach($dataOpname as $do) { ?>
                            <tr>
                                <input type="hidden" name="kodeStok" id="kodeStok" value="{{ $kodeStok }}">
                                <input type="hidden" name="kdbrg[]" id="kdbrg" value="{{ $do->kode_barang }}">
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="background:transparent; border: 1px;" name="{{$do->kode_barang}}[kdbrg]" id="kdbrg" value="{{$do->kode_barang}}" readonly></center>
                                </td>
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="background:transparent; border: 1px;" name="{{$do->kode_barang}}[nmbrg]" id="nmbrg" value="{{$do->nama_barang}}" readonly></center>
                                </td>
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="background:transparent; border: 1px;" name="{{$do->kode_barang}}[waktu]" id="waktu" value="{{date_format(date_create($do->waktu_stok), 'd M Y H:i:s')}}" readonly></center>
                                </td>
                                <td>
                                    <center><input type="text" class="form-control text-xs font-weight-bold text-center text-secondary my-2" style="width:60px;background:transparent; border: 1px;" name="{{$do->kode_barang}}[jml]" id="jml" value="{{$do->jml_brg}}" readonly></center>
                                </td>
                                <td class="align-items-center">
                                    <center><input type="text" class="form-control text-center my-2" style="width:60px; border:1px;
                                    <?php
                                        if($dataOpname[0]->status=='SELESAI'){
                                        echo    'background: transparent; border: none;';
                                        }
                                        ?>
                                    " name="{{$do->kode_barang}}[aktual]" id="aktual" value="{{$do->jml_aktual}}" readonly></center>
                                </td>
                                <td class="align-items-center">
                                    <center><input type="text" class="form-control text-center my-2"  style="width:60px;background: transparent; border: none;" name="{{$do->kode_barang}}[selisih]" id="selisih" value="{{$do->selisih}}"readonly></center>
                                </td>
                                <?php
                                if($dataOpname[0]->status=='PROSES'){
                                echo    '<td class="align-middle">
                                            <a type="button" name="btn-edit" id="btn-edit" data-bs-toggle="tooltip" data-bs-original-title="Edit" value="enable"><i class="fa-regular fa-pen-to-square"></i></a>
                                        </td>';
                                }
                                ?>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                            <?php
                            if($dataOpname[0]->status=='PROSES'){
                                echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn bg-gradient-warning btn-sm mx-3 my-3">Simpan</button>
                                     </div>';
                            }
                            ?>

                        </form>
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

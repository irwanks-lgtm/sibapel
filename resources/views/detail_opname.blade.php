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
                            <h5 class="mb-0">Tabel Data Stok Opname :</h5>
                        </div>
                        
                        <table>
                            <td>
                                <a href="download/final/opname?" class="btn bg-gradient-success btn-sm my-2" type="button">CETAK</a>
                            </td>
                            <td>
                                <a href="{{ url()->previous() }}" class="btn bg-gradient-warning btn-sm mx-2  my-2" type="button">Kembali</a>
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
                                </tr>
                            </thead>
                            <?php foreach($data as $d) { ?>
                            <tbody class="text-center">
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $d->kode_barang; ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $d->nama_barang; ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo DATE_FORMAT(date_create($d->waktu_stok), "d/m/Y H:i:s "); ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $d->jml_sistem; ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $d->jml_aktual; ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $d->selisih; ?></p>
                                    </td>
                                </tr>
                            </tbody>
                            <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
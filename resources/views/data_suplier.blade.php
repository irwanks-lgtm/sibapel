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
                            <h5 class="mb-0">Data Suplier</h5>
                        </div>
                        <?php if(Str::contains(Session::get('idUser'), 'ADM')){ ?>
                          <a href="tambah-suplier" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Data</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center table-hover mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">id suplier</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nama suplier</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">alamat</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">no. hp</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">pembayaran</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action </th>
                    </tr>
                  </thead>
                  <?php foreach($suplier as $sup) { ?>
                    <tbody class="text-center">
                    <tr>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $sup->id_suplier; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $sup->nama_suplier; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $sup->alamat; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $sup->no_hp; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $sup->pembayaran; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php if(!$sup->keterangan){ echo "----"; }else{ echo $sup->keterangan; } ?></p>
                      </td>
                      <td class="align-middle">
                        <a href="edit-suplier/{{$sup->id_suplier}}" class="btn bg-gradient-info btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="hapussup/{{$sup->id_suplier}}" class="btn bg-gradient-danger btn-xs mb-0" type="button" data-bs-toggle="tooltip" data-bs-original-title="Hapus">
                          <i class="fa-regular fa-trash-can"></i>
                        </a>
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
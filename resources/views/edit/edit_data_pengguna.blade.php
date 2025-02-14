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
                    <h5 class="mb-0">Edit Data Pengguna</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">< &nbsp; Kembali</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body" style="padding-left: 120px">
                  <form method="POST" action="{{ url('/editpengguna')}}" autocomplete="off">    
                  @csrf              
                    <div class="mb-2">
                      <table>
                        <?php foreach($user as $us) { ?>
                        <input type="hidden" class="form-control my-2" name="id" value="<?php echo $us->id_pengguna ?>">
                        <tr>
                          <td><label>E-Mail</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="email" class="form-control my-2" placeholder="E-Mail" name="email" value="<?php echo $us->email ?>">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Nama </label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Nama Pengguna" name="nama" value="<?php echo $us->nama_pengguna ?>">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Password </label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="password" class="form-control my-2" placeholder="Password" name="password" value="<?php echo $us->id_pengguna ?>">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Alamat</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" placeholder="Alamat" name="alamat" value="<?php echo $us->alamat ?>">
                          </td>
                        </tr>
                        <tr >
                          <td><label>Tempat Lahir</label></td>
                          <td style="padding-left: 20px;">
                            <input type="text" class="form-control my-2" placeholder="Tempat Lahir" name="tmpt" value="<?php echo $us->tempat_lhr ?>">
                          </td>
                          <td style="padding-left:20px;"><label>Tgl Lahir</label></td>
                          <td style="padding-left: 20px;">
                            <input type="date" class="form-control my-2" name="tgl_lhr" value="<?php echo $us->tgl_lhr ?>">
                          </td>
                        </tr>
                        <tr >
                          <td><label>No. HP</label></td>
                          <td style="padding-left: 20px;">
                          <input type="text" class="form-control my-2" name="nohp" id="nohp" placeholder="Nomor Handphone" value="<?php echo $us->nomor_hp ?>">
                          </td>
                        </tr>
                        <tr>
                          <td><label>Role</label></td>
                          <td colspan="3" style="padding-left: 20px;">
                            <select name="role" id="role" class="form-select my-2" >
                              <option selected>Pilih Role Pengguna...</option>
                              <option <?php if($us->role=='admin'){echo 'selected="selected"';} ?> value="admin">Admin</option>
                              <option <?php if($us->role=='karyawan'){echo 'selected="selected"';} ?> value="karyawan">Karyawan</option>
                            </select>
                          </td>
                        </tr>
                      </table>
                      <?php } ?>
                    </div>
                    <button type="submit" class="btn bg-gradient-success w-10 mt-4 mb-0">Simpan</button>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  @endsection

@extends('layouts.user_type.auth')

@section('content')
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <script src="https://kit.fontawesome.com/af4366748c.js" crossorigin="anonymous"></script>
  <div class="row animate__animated animate__bounceInLeft animate__delay-1s">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Barang</p>
                <h5 class="font-weight-bolder mb-0">{{$jmlBrg}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pengguna</p>
                <h5 class="font-weight-bolder mb-0">{{$jmlUser}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Suplier</p>
                <h5 class="font-weight-bolder mb-0">
                {{$jmlSup}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Penjualan</p>
                <h5 class="font-weight-bolder mb-0">
                  @currency($total)
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4 animate__animated animate__bounceInLeft animate__delay-1s">
    <div class="col-lg-6  mb-4">
      <div class="card z-index-3">
        <div class="card-body p-3">
          <div class="bg-gradient-light border-radius-lg py-3 px-2 mb-3">
            <h6 class="ms-2 mt-4 mb-0"> Barang Hampir Habis </h6>
          <p class="text-sm ms-2">List barang hampir habis </p>
          <div class="container border-radius-lg">
          <?php if($stokbrg->isEmpty()) { echo "<div class=\"text-center\">Tidak Ada Barang Hampir Habis</div>";} else{?>
            <table class="table table-stripped">
            <?php $i=1; foreach($stokbrg as $sb) { ?>
              <tr>
                <td>
                  {{$i.".". " " .$sb->nama_barang}}
                </td>
                <td class="text-danger">
                  {{$sb->jml_brg}}
                </td>
              </tr>
            <?php $i++; } ?>
            </table>
          <?php } ?>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6 class="ms-2 mt-4 mb-0"> Barang Terjual </h6>
          <p class="text-sm ms-2">List barang paling laku </p>
          <div class="container border-radius-lg">
          <?php if($hotsale->isEmpty()) { echo "<div class=\"text-center\">Belum Ada Barang Terjual</div>";} else{?>
            <table class="table table-stripped">
            <?php $i=1; foreach($hotsale as $hs) { ?>
              <tr>
                <td>
                  {{$i.".". " " .$hs->nama_barang}}
                </td>
                <td>
                  {{$hs->jual}}
                </td>
              </tr>
            <?php $i++; } ?>
            </table>
          <?php } ?>
          </div>
        </div>
        <div class="card-body p-1">

        </div>
      </div>
    </div>
  </div>
@endsection


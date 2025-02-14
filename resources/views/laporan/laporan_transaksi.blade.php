@extends('layouts.user_type.auth')

@section('content')
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  
  <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/plug-ins/2.1.8/dataRender/datetime.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.js"></script>

  
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg animate__animated animate__bounceInLeft animate__delay-1s">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Laporan Transaksi</h5>
                </div>
                  <a href="{{url('transaksi')}}" class="btn bg-gradient-success btn-sm mb-0 mx-2" type="button">CETAK</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="container mt-5">
                  <table class="table table-bordered" id="users-table">
                      <thead class="table-success">
                         <tr>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Kode Transaksi</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Nama Barang</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Jenis Transaksi</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah Barang</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Harga</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tanggal Transaksi</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Keterangan</th>
                          </tr>
                     </thead>
                 </table>
             </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  <script>
    
  </script>
  <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                order: [[5, 'asc']],
                ajax: {
                  url: '{{ route("laporan.transaksi") }}',

                }, // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'kode_transaksi',
                        name: 'kode_transaksi'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'jenis_transaksi',
                        name: 'jenis_transaksi'
                    },
                    {
                        data: 'jml',
                        name: 'jml'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        render:  $.fn.dataTable.render.number('.', null , null, 'Rp. ')
                         
                    },
                    {
                        data: 'tgl_transaksi',
                        name: 'tgl_transaksi',
                        render: function ( data, type, row ) {
                          var dateSplit = data.split(/ |-/);
                          return type === "display" || type === "filter" ?
                          dateSplit[2] +'-'+ dateSplit[1] +'-'+ dateSplit[0] + ' ' + dateSplit[3] :
                          data;
                        }
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                ],
                columnDefs: [
                    { width: '70px', targets: [ 2, 3 ] },
                    { className: 'dt-center', targets: '_all' }
                ],
                initComplete: function () {
                }
            });
        });
    </script>
  
  @endsection

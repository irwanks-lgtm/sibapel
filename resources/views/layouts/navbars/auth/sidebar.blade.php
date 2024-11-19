<style>
.sidenav {
  overflow: overlay;
}
::-webkit-scrollbar {
  display: none;
}

::-webkit-scrollbar-thumb {
  display : none;
}

::-webkit-scrollbar-track {
  display : none;
}
</style>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <script src="https://kit.fontawesome.com/af4366748c.js" crossorigin="anonymous"></script>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 animate__animated animate__bounceInLeft" id="sidenav-main" style="background-color:black">
  <div class="sidenav-header ">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="../assets/img/Logo-MS.png" class="navbar-brand-img h-100" alt="Logo Moro Seneng">
        <span class="ms-2 fs-5 font-weight-bold text-white">MORO SENENG</span>
    </a>
  </div>
  <hr class="horizontal m-auto" style="height:6px;border-width:0;color:white;background-color:white;">
  <div class="collapse navbar-collapse  w-auto mt-2" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-table-columns" style="font-size: 1rem; {{ (Request::is('dashboard') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('dashboard') ? 'text-dark' : 'text-white') }}">Dashboard</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-white">Manajemen Barang</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('barang-masuk') ? 'active' : '') }}" href="{{ url('barang-masuk') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-box-open" style="font-size: 1rem; {{ (Request::is('barang-masuk') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('barang-masuk') ? 'text-dark' : 'text-white') }}">Barang Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('barang-keluar') ? 'active' : '') }}" href="{{ url('barang-keluar') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-boxes-packing" style="font-size: 1rem; {{ (Request::is('barang-keluar') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('barang-keluar') ? 'text-dark' : 'text-white') }}">Barang Keluar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('stok-opname') ? 'active' : '') }}" href="{{ url('stok-opname') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-dolly" style="font-size: 1rem; {{ (Request::is('stok-opname') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('stok-opname') ? 'text-dark' : 'text-white') }}">Stok Opname</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-white">Manajemen Data</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('data-pengguna') ? 'active' : '') }}" href="{{ url('data-pengguna') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-people-group ps-2 pe-2 {{ (Request::is('data-pengguna') ? 'text-white' : 'text-dark') }} "></i>
            </div>
            <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('data-pengguna') ? 'text-dark' : 'text-white') }}">Data Pengguna</span>
        </a>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('data-suplier') ? 'active' : '') }}" href="{{ url('data-suplier') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-users-gear" style=" font-size: 1rem;{{ (Request::is('data-suplier') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('data-suplier') ? 'text-dark' : 'text-white') }}">Data Suplier</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('data-barang') ? 'active' : '') }}" href="{{ url('data-barang') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-boxes-stacked" style="font-size: 1rem; {{ (Request::is('data-barang') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('data-barang') ? 'text-dark' : 'text-white') }}">Data Barang</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-white">Penjualan</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('pos') ? 'active' : '') }}" href="{{ url('pos') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-cart-shopping" style="font-size: 1rem; {{ (Request::is('pos') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('pos') ? 'text-dark' : 'text-white') }}">Point Of Sale</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-white">Laporan</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('pos') ? 'active' : '') }}" href="{{ url('pos') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-money-bill-wave" style="font-size: 1rem; {{ (Request::is('pos') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('pos') ? 'text-dark' : 'text-white') }}">Laporan Penjualan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('pos') ? 'active' : '') }}" href="{{ url('pos') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-check-to-slot" style="font-size: 1rem; {{ (Request::is('pos') ? 'color:white;' : 'color:black;') }}"></i>
          </div>
          <span class="nav-link-text font-weight-bold ms-1 {{ (Request::is('pos') ? 'text-dark' : 'text-white') }}">Laporan Transaksi</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

@extends('layouts.user_type.auth')

@section('content')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <main class="main-content position-relative mt-1 border-radius-lg animate__animated animate__bounceInLeft animate__delay-1s">
    <style>
      .return{
        background-image: url('../assets/img/return.png');
        
        background-color: transparent;
        font-size: 1.5em;
      }
    </style>
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Tambah Barang Keluar</h5>
                </div>
                <a href="{{ url()->previous() }}" class="btn bg-gradient-dark btn-sm mb-0" type="button">
                  <i class="fa-solid fa-arrow-left fa-sm">
                    <span class="nav-link-text font-weight-bold ms-1"></i>Back</span>
                </a>
            </div>
            <div class="px-4 mt-0 mb-0">
              <hr style="height:3px;color:black;background-color:black">
            </div>
            <div class="d-flex flex-row justify-content-between py-5 px-8">
              <a href="#" class="btn bg-gradient-dark btn-lg mb-0" style="width:200px;height:200px;" type="button">
                <p class="text-center font-weight-bolder mb-0 py-6">RETUR</p>
              </a>
              <a href="#" class="btn bg-gradient-secondary btn-lg mb-0" style="width:200px;" type="button">
                <p class="text-center font-weight-bolder mb-0 py-6">RESELLER</p>
              </a>
              <a href="#" class="btn bg-gradient-light btn-lg mb-0" style="width:200px;" type="button">
                <p class="text-center font-weight-bolder mb-0 py-6">LAINNYA</p>
              </a>
            </div>
          </div>
        </div>
      </div>
  </main>
  
  @endsection

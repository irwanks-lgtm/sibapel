<!-- Navbar -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<style>
    .navbar {
  --animate-delay: 0.5s;
}
</style>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl animate__animated animate__bounceInLeft animate__delay-1s" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ strtok(str_replace([':', '-'], ' ', Request::path()), '/') }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ strtoupper(strtok(str_replace([':', '-'], ' ', Request::path()), '/')) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar"> 
            <ul class="navbar-nav  justify-content-end"><u class="text-success">
            <li class="nav-item d-flex align-items-center text-success">
                <p class="text-success mt-3 px-2">{{ Str::title(Session::get('name')) }}</p></u>
                <i class="fa-regular fa-circle-user me-sm-1"></i>
            </li>
            <li class="nav-item d-flex align-items-center text-danger">
                <a href="{{ url('/logout')}}" class="nav-link text-body font-weight-bold">
                    <span class="d-sm-inline d-none">Keluar</span>
                    <i class="fa-solid fa-right-from-bracket text-danger px-1"></i>
                </a>
            </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
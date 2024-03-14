@extends('layouts.app')

@section('auth')

    @if(\Request::is('static-sign-up'))
        @yield('content')
    
    @elseif (\Request::is('static-sign-in')) 
            @yield('content')
    
    @else
            @include('layouts.navbars.auth.sidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
                @include('layouts.navbars.auth.nav')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
    @endif

@endsection
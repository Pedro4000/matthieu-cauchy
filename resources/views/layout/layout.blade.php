<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>@yield('titre') - {{ Str::replace('_',' ',config('app.name', '')) }}</title>
</title>
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <link rel="icon" href="{{ asset('storage/favicon/favicon3.ico')}}" />
  </head>
  <body>
    <header>
      <div class="row">
        <div class="col-3 col-md-1 col-lg-2 sidebar pl-4 pr-0">
          <div id="sidebar_sticky" class="sticky-top">
  @yield('sidebar')
          </div>
        </div>        
        <div class="col-9 col-md-11">
  @include('include.topbar')
        </div>
      </div>
    </header>
    <div id="haut_de_page" role="main" class="main container-fluid">
      <div class="row">
        <div id="content" class="col-11 cold col-lg-10 px-4 mt-6 mx-auto">
@yield('headcontent')
@yield('content')
        </div>
      </div>
    </div>
    <div class="footer bg-dark text-cbo-4 text-right text-truncate">
      <p class="m-0 pr-5">
{{--@include('include.bottombar')--}}
      </p>
    </div>
@include('include.foot')
  </body>
</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>@yield('titre') - {{ Str::replace('_',' ',config('app.name', '')) }}</title>
</title>
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/fonts/fonts.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <link rel="icon" href="{{ asset('storage/favicon/favicon3.ico')}}" />
  </head>
  <body>
    <header>
      <div class="navbar navbar-expand-md navbar-dark fixed-top">
@include('include.topbar')
      </div>
    </header>
    <div id="haut_de_page" role="main" class="main container-fluid">
      <div class="row">
        <div class="col-1 col-lg-2 sidebar pl-4 pr-0">
          <div id="sidebar_sticky" class="sticky-top">
@yield('sidebar')
          </div>
        </div>
        <div id="content" class="col-11 col-lg-10 px-4">
@yield('headcontent')
@yield('content')
        </div>
      </div>
    </div>
    <div class="footer bg-dark text-cbo-4 text-right text-truncate">
      <p class="m-0 pr-5">
@include('include.bottombar')
      </p>
    </div>
@include('include.foot')
  </body>
</html>

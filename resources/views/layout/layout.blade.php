<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>@yield('titre') - {{ Str::replace('_',' ',config('app.name', '')) }}</title>
</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://kit.fontawesome.com/23527384bb.js" crossorigin="anonymous"></script>    
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <link rel="icon" href="{{ asset('storage/favicon/favicon3.ico')}}" />
  </head>
  <body class="bottom-right-class" style="{{ Route::currentRouteName() != 'home' ? 'background: rgb(249, 249, 251)'
 : '' }}">
    <header>
      <div class="row w-100">
        <div class="col-3 col-lg-1 col-xl-2 sidebar pl-4 pr-0">
          <div id="sidebar_sticky" class="sticky-top">
  @yield('sidebar')
          </div>
        </div>     
        <div class="col-9  sm:mt-0 mt-4 {{ Route::currentRouteName() != 'home' ? 'hidden-away' : ''}}">
  @include('include.topbar')
        </div>
      </div>
    </header>
    <div id="haut_de_page" role="main" class="main container-fluid">
      <div class="row">
        <div id="content" class="col-12 cold col-lg-10 px-4 mt-6 mx-auto">
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
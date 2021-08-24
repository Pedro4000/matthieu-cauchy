<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
@include('include.head')
  </head>
  <body>
    <header>
      <div class="navbar navbar-expand-md navbar-dark fixed-top">
@include('include.topbar')
      </div>
    </header>
    <div id="haut_de_page" role="main" class="main container-fluid">
      <div class="row">
        <div class="col-1 col-lg-2 sidebar pl-0 pr-0">
          <div id="sidebar_sticky" class="sticky-top">
@yield('sidebar')
          </div>
        </div>
        <div id="content" class="col-11 col-lg-10 ml-auto px-4">
@yield('headcontent')
@include('include.message')
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

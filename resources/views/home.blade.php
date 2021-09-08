@php
use Carbon\Carbon;
@endphp

@extends('layout.layout')

@section('titre')
@endsection

@section('sidebar')
@include('include.sidebar')
@endsection

@section('headcontent')
<div class="d-flex justify-content-end pt-1">
</div>
<div class="d-flex mb-1 flex-column">
  <h1 class="h2">@yield('titre')</h1>
</div>
@endsection

@section('content')
<div class="row ">

  <div id="stage">
    <img src="{{ asset('storage/images/martha1/03_15_10_2016-copy.jpg') }}" >
    <img src="{{ asset('storage/images/coucou-magazine3/_432x540_tomorrowland-cauchy-cavallin-1.jpg') }}" >
    <img src="{{ asset('storage/images/silence1/_540x540_mb013.jpg') }}" >
    <img src="{{ asset('storage/images/martha1/03_15_10_2016-copy.jpg') }}" >
    <img src="{{ asset('storage/images/coucou-magazine3/_432x540_tomorrowland-cauchy-cavallin-1.jpg') }}" >
    <img src="{{ asset('storage/images/silence1/_540x540_mb013.jpg') }}" >
  </div>

</div>
@endsection




@php
use Carbon\Carbon;
@endphp

@extends('layout.layout')

@section('titre')
home
@endsection

@section('sidebar')
@include('include.sidebar')
@endsection

@section('headcontent')
<div class="d-flex justify-content-end pt-1">
</div>
<div class="d-flex mb-1 flex-column">
  <h1 class="h2"></h1>
</div>
@endsection

@section('content')
<div class="row col-10">
  <div id="stage">
    <img src="{{ asset('storage/images/martha1/03_15_10_2016-copy.jpg') }}" style="display:none">
    <img src="{{ asset('storage/images/coucou-magazine3/_432x540_tomorrowland-cauchy-cavallin-1.jpg') }}" style="display:none" >
    <img src="{{ asset('storage/images/silence1/_540x540_mb013.jpg') }}"style="display:none" >
    <img src="{{ asset('storage/images/coucou-magazine1/_432x540_test_selec12.jpg') }}" style="display:none">
  </div>

</div>
@endsection



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
<div class="row col-11" style="height:80vh">
  
  <div class="w-1/3 text-center">

    <div class="inline-block premiere_galerie">
      <img src="{{ asset('storage/images/works/silence/mb013.jpg') }}" class="inline-block h-60 premiere-galerie-image">
      <div class="centered-title">SILENCE</div>
    </div>
    {{--@foreach ($photos as $photo)_432x540_test_selec18.jpg
    <img src="{{ asset('storage/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}" style="display:none">
    @endforeach--}}
  </div>

  <div class="w-1/3 text-center">
    <div class="inline-block" style="position:absolute;"><img src="{{ asset('storage/images/works/martha/martha_n.jpg') }}" class="inline-block  h-60"></div>
  </div>


  <div class="w-1/3 text-center">
    <div class="ml-2/3 inline-block"><img src="{{ asset('storage/images/works/martha/martha_n.jpg') }}" class="inline-block  h-60"></div>
  </div>

</div>
@endsection



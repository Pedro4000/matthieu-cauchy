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

<div class="row col-start-1 col-10 m-auto projects_div opaque">
  <div class="w-1/2 md:w-1/3 text-center d-flex align-items-start h-60">
    <div class="inline-block premiere_galerie">
      <a href="{{ route('album', ['album_nom' => $albums['works']['martha']->nom ]) }}">
        <img src="{{ asset('storage/images/works/silence/mb013.jpg') }}" class="inline-block premiere-galerie-image">
        <div class="centered-title">SILENCE</div>
      </a>
    </div>
    {{--@foreach ($photos as $photo)_432x540_test_selec18.jpg
    <img src="{{ asset('storage/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}" style="display:none">
    @endforeach--}}
  </div>

  <div class="w-1/2 md:w-1/3 text-center d-flex align-items-end h-60">
    <div class="inline-block premiere_galerie">
      <img src="{{ asset('storage/images/works/martha/martha_n.jpg') }}" class="inline-block premiere-galerie-image">
      <div class="centered-title">MARTHA</div>      
    </div>
  </div>


  <div class="w-1/2 md:w-1/3 text-center d-flex align-items-start h-60">
    <div class="inline-block premiere_galerie">
      <img src="{{ asset('storage/images/books/premiere classe/squaez.jpg') }}" class="inline-block premiere-galerie-image">
      <div class="centered-title">COUCOU-MAGAZINE</div>            
    </div>
  </div>

</div>
@endsection



@php
use Carbon\Carbon;
@endphp

@extends('layout.layout')

@section('titre')
section
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
<div class="row">

  <div id="stage" class="">
    <div class='slider_component blabla' style="display:none">{{ $album->description }}</div>
    @foreach($album->photos as $photo)
    <img src="{{ asset('storage/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}" style="display:none" class="slider_component">
    @endforeach
  </div>

</div>
<div class="retour">
  <a href="{{ route('home', [ 'section_display' => 'projects' ]) }}">
    {{-- <img src="{{ asset('storage/favicon/left-arrow.png') }}" class="fleche-retour"> retour --}}
    <i class="fas fa-long-arrow-alt-left"></i> retour
  </a>
</div>
@endsection




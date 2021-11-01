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
<div class="row col-10">

  <div id="stage">
    @foreach($album->photos as $photo)
    <img src="{{ asset('storage/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}" style="display:none">
    @endforeach
  </div>

</div>
@endsection




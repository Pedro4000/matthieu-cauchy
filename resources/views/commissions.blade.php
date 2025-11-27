@php
use Carbon\Carbon;
@endphp

@extends('layout.layout')

@section('titre')
commissions
@endsection

@section('sidebar')
@include('include.sidebar')
@endsection

@section('headcontent')
<div class="flex justify-content-end pt-1">
</div>
<div class="flex mb-1 flex-column">
  <h1 class="h2"></h1>
</div>
<style>
.commission-photo {
  width: 100%;
  max-width: 100%;
  height: auto;
  display: block;
  margin-bottom: 2rem;
}

.commissions-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
  padding-bottom: 30px;
}

.commissions-retour {
  position: fixed;
  bottom: 30px;
  right: 5%;
  z-index: 9999;
}

.commissions-retour a {
  color: #333;
  text-decoration: none;
  transition: color 0.2s ease;
}

.commissions-retour a:hover {
  color: #000;
  text-decoration: none;
}

@media screen and (max-width: 980px) {
  .commissions-retour {
    bottom: 50px;
  }
}
</style>
@endsection

@section('content')
<div class="row">
  <div class="commissions-container">
    @foreach($commissionedPhotos as $photo)
      <img src="{{ asset('storage/commissioned_photos/'. $photo->filename) }}" class="commission-photo" alt="Commission">
    @endforeach
  </div>
</div>

<div class="commissions-retour text-4xl lg:text-base">
  <a href="{{ route('home', [ 'section_display' => 'projects' ]) }}">
    <i class="fas fa-long-arrow-alt-left"></i> retour
  </a>
</div>
@endsection


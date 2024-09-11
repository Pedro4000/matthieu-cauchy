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
<div class="flex justify-content-end pt-1">
</div>
<div class="flex mb-1 flex-column">
  <h1 class="h2"></h1>
</div>
<style>
.slider_component {
  position: relative;
    height: 100vh; /* Adjust as needed */
    overflow: hidden;
}

.slider_component img {
  position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
}
  </style>
@endsection

@section('content')
<div class="row">

  <div id="stage" class="relative">
    @foreach($album->photos as $photo)
    <div class="absolute w-full h-full flex">
      
      <span class='left-click w-1/2 h-full next-image'>
      </span>

      <span class='right-click w-1/2 h-full previous-image'>
      </span>

    </div>
    <img src="{{ asset('storage/images/'.$photo->album->type->nom.'/'.$photo->album->nom_route.'/'.$photo->nom_fichier) }}" style="display:none" class="slider_component">
    @endforeach
  </div>

</div>
@if ($album->description != '')
  <button id="modalButton" type="button" class="album-description-cta hover:bg-gray-100 text-gray py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2 text-4xl lg:text-base">texte</button>                                
@endif

<div class="retour text-4xl lg:text-base py-2 px-4">
  <a href="{{ route('home', [ 'section_display' => 'projects' ]) }}">
    {{-- <img src="{{ asset('storage/favicon/left-arrow.png') }}" class="fleche-retour"> retour --}}
    <i class="fas fa-long-arrow-alt-left"></i> retour
  </a>
</div>

@if ($album->description != '')

<!-- Modal texte -->
<div id="myModal" class="modal text-4xl lg:text-base">
  <div class="modal-content lg:w-1/4 lg:min-h-full">
    <div class="modal-header p-2 text-8xl lg:text-base">
      <h2><b></b></h2>
      <span class="close fermer">&times;</span>
    </div>
    <div class="modal-body p-8 leading-relaxed lg:leading-normal">
      <p class='m-2'>{!! $album->description !!}</p>
    </div>
    {{--<div class="modal-footer">
      <h3></h3>
    </div>--}}
  </div>
</div>       
@endif     
@endsection




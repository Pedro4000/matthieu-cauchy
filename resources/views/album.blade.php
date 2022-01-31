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
@endsection

@section('content')
<div class="row">

  <div id="stage" class="">
    @foreach($album->photos as $photo)
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
  <div class="modal-content lg:w-1/4 lg:h-full">
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




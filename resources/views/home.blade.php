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
<div class="flex justify-content-end pt-1">
</div>
<div class="flex mb-1 flex-column">
  <h1 class="h2"></h1>
</div>
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
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

<img src="chambre3.jpeg" alt="Italian Trulli" class='hidden'>
@if(isset($photoAccueil))
  <div id="stageAccueil" class="{{  app('request')->input('section_display') ? 'hidden-away opaque' : '' }}" style="{{ app('request')->input('section_display') ? 'position:absolute' : '' }}" >
    <img src="{{ asset('storage/photos/'.$photoAccueil->filename) }}">
  </div>
@endif

<div id="album-div" class="m-auto flex flex-wrap flex-col lg:flex-row projects_div {{ app('request')->input('section_display') == 'projects' ? '' : 'hidden-away opaque' }}">
  @isset($albums)
    @foreach($albums as $album)
      @foreach($album->photos as $photo) 
        @if($photo->cover)
        <div class="w-full lg:w-1/2 mb-7 lg:mb-0 lg:px-3 text-center flex home-main-element lg:p-6">
          <a href="{{ route('album', ['albumName' => $album->name ]) }}" class="premiere-galerie-lien">
            @if(strtolower($album->name) == 'martha')
              <div class="inline-block premiere_galerie flex items-center w-full"  style="background-image: url({{ asset('marthamain.jpeg') }})">
            @else
              <div class="inline-block premiere_galerie flex items-center w-full"  style="background-image: url({{ isset($photo->cover) ? asset('storage/photos/' . $photo->filename) : ''  }})">
            @endif
            </div>
            <div class="centered-title">{{ Str::of($album->name)->upper() }}</div>
          </a>
        </div>
        @endif
      @endforeach
    @endforeach
  @endisset

  <a href='https://www.obscuramachine.com/' target="_blank" class="w-full lg:w-1/2 mb-7 lg:mb-0 lg:mb-0 px-3 text-center flex lg:justify-end lg:items-start pointer home-main-element lg:p-6">
    <div id="" class="premiere-galerie-lien inline-block flex items-center w-full">
        <div class="w-full premiere_galerie oscura-machine">
        </div>
        <div class="centered-title">OSCURA MACHINE</div>
    </div>
  </a>
</div>

<div class="row mx-8 m-auto mb-5 a_propos_div a-propos hidden-away opaque">
  <div class="a-propos-langues-div mb-4 text-right">
      @foreach ($AllAPropos as $aPropos)
        <span class="a-propos-langue pointer underline mr-2 text-4xl lg:text-lg {{ $loop->first ? 'hidden' : '' }}" data-langue={{ $aPropos->langue }}>
          {!! $aPropos->langue !!}
        </span>
      @endforeach
  </div>
  @foreach ($AllAPropos as $aPropos)
    <span class="a-propos-texte {{ $loop->first ? '' : 'hidden' }}" data-langue={{ $aPropos->langue }}>
      {!! $aPropos->contenu !!}
    </span>
  @endforeach
</div>

<div class="commissions_div commissions-div {{ app('request')->input('section_display') == 'commissions' ? '' : 'hidden-away opaque' }}">
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
</div>

<div class="contact_form_div contact-div mx-8 {{ app('request')->input('section_display') == 'contact' ? '' : 'hidden-away opaque' }}">

  @if( app('request')->input('message') == 'ok')
    <div class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow alert alert-success alert-dismissible fade show flex justify-content-between" role="alert">
      <strong> envoyé !</strong>
    </div>
  @endif
  <form class="hidden contact-form grid m-auto" action="{{ route('contact.form') }}" >
    @csrf
    <div class="mb-2 grid">
      <label class="col-span-12 text-center" for="contact_name">Nom</label>
      <input type="text" name="contact_name" class="col-span-12 home-input text-5xl lg:text-xl">
    </div>
    <div class="mb-7 grid">
      <label class="col-span-12 text-center" for="contact_message">Message</label>
      <textarea name="contact_message" class="col-span-12 contact_message home-input text-5xl lg:text-xl"></textarea>    
    </div>
    <div class="mb-2 text-right ">
      <button type="submit">Envoyer </button>
    </div>
  </form>
  <div class='contact-container'>
    <div class="mt-5" style='text-align:right'>
      <p class="text-center mb-2">{!! $contactText->content !!}</p>
    </div>
  </div>

</div>
@endsection

@push('scripts')
    <script>

      if (($('.premiere_galerie').length)%3 == 0) {
        console.log('ok');
        $('#album-div').addClass('lg:justify-end');
        $('.coucou_liens').addClass('lg:justify-center');
      } else {
        console.log('pasok');
        $('#album-div').addClass('lg:justify-start');
        $('coucou_liens').addClass('lg:justify-center');
      };

      $(document).ready(function() {

        function affichageHamburger() {
          if ($(window).width() > 980) {
            width = $(window).width();
            $('.hamburger-nav').addClass('hidden');
            $('.desktop-nav').removeClass('hidden');
          } else {
            $('.hamburger-nav').removeClass('hidden');
            $('.desktop-nav').addClass('hidden');
          }
        };

        new affichageHamburger();
        $(window).resize(affichageHamburger);

        $('.premiere-galerie-lien').height($('.premiere-galerie-lien').width())
        $('.premiere_galerie').height($('.premiere_galerie').width())

        $(window).resize(function(){
          $('.premiere-galerie-lien').height($('.premiere-galerie-lien').width())
          $('.premiere_galerie').height($('.premiere_galerie').width())
        })

      });
    </script>
@endpush

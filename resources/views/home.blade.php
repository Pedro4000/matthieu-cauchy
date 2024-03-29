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
@endsection


@section('content')

@if(isset($photoAccueil))
  <div id="stageAccueil" class="{{  app('request')->input('section_display') ? 'hidden-away opaque' : '' }}" style="{{ app('request')->input('section_display') ? 'position:absolute' : '' }}" >
    <img src="{{ asset('storage/images/'.$photoAccueil->album->type->nom.'/'.$photoAccueil->album->nom_route.'/'.$photoAccueil->nom_fichier) }}">
  </div>
@endif

<div id="album-div" class="m-auto flex flex-wrap flex-col lg:flex-row projects_div {{ app('request')->input('section_display') == 'projects' ? '' : 'hidden-away opaque' }}">
 @foreach($albums['works'] as $work)
  <div class="w-full lg:w-1/2 mb-7 lg:mb-0 px-3 text-center flex home-main-element lg:p-6">
    <a href="{{ route('album', ['album_nom' => $work->nom ]) }}" class="premiere-galerie-lien">
      <div class="inline-block premiere_galerie flex items-center w-full"  style="background-image: url({{ isset($work->couv) ? "'".asset('storage/images/works/'.$work->nom_route.'/'.$work->couv->nom_fichier)."'" : ''  }})">
      </div>
      <div class="centered-title">{{ Str::of($work->nom)->upper() }}</div>
    </a>
  </div>
      
@endforeach


  <a href='https://coucoumagazine.fr/' target="_blank" class="w-full lg:w-1/2 mb-7 lg:mb-0 lg:mb-0 px-3 text-center flex lg:justify-end lg:items-start pointer home-main-element lg:p-6">
    <div id="" class="premiere-galerie-lien inline-block flex items-center w-full">
      @if (isset($photoCouvCoucou))
        <div class="w-full premiere_galerie" style="background-image: url({{ isset($photoCouvCoucou) ? "'".asset('storage/images/'.$photoCouvCoucou->album->type->nom.'/'.$photoCouvCoucou->album->nom_route.'/'.$photoCouvCoucou->nom_fichier)."'" : ''  }})">
        </div>
        <div class="centered-title">COUCOU-MAGAZINE</div>        
      @endif    
    </div>
  </a>

  {{--
  <div class="w-full lg:w-1/3 mb-7 lg:mb-0 px-3 text-center flex lg:justify-end lg:items-start pointer home-main-element">
    <div id="coucou_image" class="premiere-galerie-lien inline-block flex items-center w-full">
      @if (isset($photoCouvCoucou))
        <div class="w-full premiere_galerie" style="background-image: url({{ isset($photoCouvCoucou) ? "'".asset('storage/images/'.$photoCouvCoucou->album->type->nom.'/'.$photoCouvCoucou->album->nom_route.'/'.$photoCouvCoucou->nom_fichier)."'" : ''  }})">
        </div>
        <div class="centered-title">COUCOU-MAGAZINE</div>        
      @endif    
    </div>
  </div>

  <div class="w-full lg:w-1/3 mb-7 lg:mb-0 px-3 text-center flex flex-col coucou_liens hidden-away home-main-element justify-center items-center">
      @foreach($albums['books'] as $book)
        <a href="{{ route('album', ['album_nom' => $book->nom ]) }}" class="text-left opaque">
          <p class="flex items-center w-100 my-3"><img class="mx-2" style="width:30px; border-radius: 50%; padding: 2px" src="{{ asset($planets[rand(0, count($planets)-1) ]) }}">{{ $book->nom }}</p>
        </a>  
      @endforeach
  </div>
--}}
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
  <div class="mt-5">
    <p class="text-center mb-2">Mattcau@msn.com</p>
    <p class="text-center mb-2">ou</p>
    <p class="text-center">+33 6 79 68 07 68</p>
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

        console.log($('.premiere-galerie'));

        $(window).resize(function(){
          $('.premiere-galerie-lien').height($('.premiere-galerie-lien').width())
          $('.premiere_galerie').height($('.premiere_galerie').width())
        })
        

      });      
    </script>
@endpush

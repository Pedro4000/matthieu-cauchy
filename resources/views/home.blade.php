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
<div class="row col-11 m-auto projects_div {{ app('request')->input('section_display') == 'projects' ? '' : 'hidden-away opaque' }} hidden-away">
  <div class="w-1/2 md:w-1/3 text-center d-flex align-items-start h-60">
    <div class="inline-block premiere_galerie">
      <a href="{{ route('album', ['album_nom' => $albums['works']['martha']->nom ]) }}" class="premiere-galerie-lien">
        <img src="{{ asset('storage/images/works/silence/mb013.jpg') }}" class="inline-block premiere-galerie-image">
        <div class="centered-title">SILENCE</div>
      </a>
    </div>
  </div>

  <div class="w-1/2 md:w-1/3 text-center d-flex align-items-end h-60">
    <div class="inline-block premiere_galerie">
      <a href="{{ route('album', ['album_nom' => $albums['works']['martha']->nom ]) }}" class="premiere-galerie-lien">
          <img src="{{ asset('storage/images/works/martha/martha_n.jpg') }}" class="inline-block premiere-galerie-image">
          <div class="centered-title">MARTHA</div>      
      </a>
    </div>
  </div>


  <div class="w-1/2 md:w-1/3 text-center d-flex align-items-start h-60">
    <div class="inline-block premiere_galerie">
      <a href="{{ route('album', ['album_nom' => $albums['works']['martha']->nom ]) }}" class="premiere-galerie-lien">
        <img src="{{ asset('storage/images/books/premiere classe/squaez.jpg') }}" class="inline-block premiere-galerie-image">
        <div class="centered-title">COUCOU-MAGAZINE</div>            
      </a>
    </div>
  </div>
</div>

<div class="row col-11 m-auto mb-5 a_propos_div a-propos hidden-away">
    {!! $aPropos->contenu !!}
</div>

<div class="col-11 contact_form_div">
  <form class="contact-form row m-auto" action="{{ route('contact.form') }}">
    @csrf
    <div class="mb-2 row">
      <label class="col-3" for="contact_name">Name&nbsp:</label>
      <input type="text" name="contact_name" class="col-9 home-input">
    </div>
    <div class="mb-4 row">
      <label class="col-3" for="contact_message">Message&nbsp:</label>
      <textarea name="contact_message" class="col-9 contact_message home-input"></textarea>    
    </div>
    <div class="mb-2 text-right ">
      <button type="submit">Send </button>
    </div>
  </form>
  <div class="mt-5">
    <p class="text-center">or</p>
    <p class="text-center">+33 6 79 68 07 68</p>    
  </div>

</div>
@endsection



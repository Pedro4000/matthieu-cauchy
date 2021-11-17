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
<div class="row col-11 m-auto projects_div {{-- app('request')->input('section_display') == 'projects' ? '' : 'hidden-away opaque' --}}">
 @foreach($albums['works'] as $work)
  <div class="w-1/2 md:w-1/3 text-center d-flex {{ $loop->index % 2 == 0  ? 'align-items-start' : 'align-items-end' }} h-72">
    <div class="inline-block premiere_galerie">
      <a href="{{ route('album', ['album_nom' => $albums['works']['martha']->nom ]) }}" class="premiere-galerie-lien">
        <img src="{{ asset('storage/images/works/'.$work->nom_route.'/'.$work->couv->nom_fichier) }}" class="inline-block premiere-galerie-image">
        <div class="centered-title">{{ Str::of($work->nom)->upper() }}</div>
      </a>
    </div>
  </div>
@endforeach

  <div class="w-1/2 md:w-1/3 text-center d-flex {{ count($albums['works']) % 2 == 0  ? 'align-items-start' : 'align-items-end' }} h-72">
    <div class="inline-block premiere_galerie">
      <a href="{{ route('album', ['album_nom' => $albums['works']['martha']->nom ]) }}" class="premiere-galerie-lien">
        <img src="{{ asset('storage/images/books/premiere classe/squaez.jpg') }}" class="inline-block premiere-galerie-image">
        <div class="centered-title">COUCOU-MAGAZINE</div>            
      </a>
    </div>
  </div>

  <div class="w-1/2 md:w-1/3 text-center d-flex {{ count($albums['works']) % 2 == 0  ? 'align-items-end' : 'align-items-start' }} h-72">
      @foreach($album['books'] as $book)
        <p>$book->nom</p>
      @endforeach
  </div>

</div>

<div class="row col-11 m-auto mb-5 a_propos_div a-propos hidden-away opaque">
    {!! $aPropos->contenu !!}
</div>

<div class="col-11 contact_form_div m-auto  {{ app('request')->input('section_display') == 'contact' ? '' : 'hidden-away opaque' }}">

  @if( app('request')->input('message') == 'ok')
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
      <strong> sent !</strong>
    </div>
  @endif
  <form class="contact-form row m-auto" action="{{ route('contact.form') }}">
    @csrf
    <div class="mb-2 row">
      <label class="col-12 text-center" for="contact_name">Name</label>
      <input type="text" name="contact_name" class="col-12 home-input">
    </div>
    <div class="mb-4 row">
      <label class="col-12 text-center" for="contact_message">Message</label>
      <textarea name="contact_message" class="col-12 contact_message home-input"></textarea>    
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



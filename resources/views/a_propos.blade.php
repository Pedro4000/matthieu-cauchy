@php
use Carbon\Carbon;
@endphp

@extends('layout.layout')

@section('titre')
section
@endsectionwidt

@section('sidebar')
@include('include.sidebar')
@endsection

@section('headcontent')
<div class="flex justify-end pt-1">
</div>
<div class="flex mb-1 flex-column">
  <h1 class="h2"></h1>
</div>
@endsection

@section('content')
<div class="grid grid-cols-12 col-span-10">

  <div id="stage">
    @if($apropos)
    {!! $apropos->contenu !!}
    @endif
  </div>

</div>
@endsection




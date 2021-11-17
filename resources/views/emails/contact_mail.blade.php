@php
	use Carbon\Carbon;
@endphp
<div> de : {{ $title }}
<br> le : {{ Carbon::now()->format('d/m/Y')}}
<br> message : {{ $contenu }}
<div>
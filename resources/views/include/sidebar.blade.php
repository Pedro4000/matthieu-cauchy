
<a href="{{ route('home') }}">
	@if (Route::currentRouteName() != 'album')
		<div class="sidebar_content sticky-top text-end text-6xl lg:text-xl mt-5 lg:mt-4 md:pr-12">
			Matthieu Cauchy
		</div>
	@else 
		<div class="sidebar_content sticky-top text-end text-6xl lg:text-xl mt-5 lg:mt-4 md:pr-12">
			{{ Str::ucfirst($album->nom) }}
		</div>
	@endif
</a>


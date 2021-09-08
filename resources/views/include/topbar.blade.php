<a class="" href="{{ route('home') }}">
@if (config('app.env') === 'local')
@endif
</a>

<a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_responsive_collapsible" aria-controls="navbar_responsive_collapsible"  aria-expanded="false" aria-label="afficher la barre de navigation">
  <i class="fas fa-bars text-cbo-4"></i>
</a>

<div class="collapse navbar-collapse" id="navbar_responsive_collapsible" aria-expanded="false">

{{-- cas particulier : on n'affiche pas le bloc "login" si on est sur la page de presentation --}}


</div>


